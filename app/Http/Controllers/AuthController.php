<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Helpers\Common;
use App\Helpers\UploadImage;
use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UpdateRequest;
use App\Mail\ForgotPasswordVerificationMail;
use App\Mail\SendVerificationMail;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Services\User\GetUserAction;
use App\Services\User\UserService;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Spatie\Permission\Models\Role;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Validator;

class AuthController extends Controller
{
    // protected $googleClientService;
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */

    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'refresh', 'forgotPassword', 'resetPassword', 'loginSocial', 'loginWithGoogle', 'checkVerification', 'checkVerificationRegister']]);
        $this->middleware(['role:Supper Admin|Admin|User management'])->only('userProfilebyId', 'listUsers', 'setTimeToken');
        $this->userService = $userService;

        // $this->googleClientService = $googleClientService;
    }

    public function getUser(Request $request)
    {
        $params = $request->validate([
            'email' => 'required|string',
        ]);
        try {
            $user = $this->userService->getUser($params['email']);
            return ApiResponse::success($user, __("Get user successfully"));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return ApiResponse::error(__("get user failed"), 500);
        }
    }

    public function getUserAction(Request $request, GetUserAction $action)
    {
        $params = $request->validate([
            'email' => 'required|string',
        ]);
        $user = $action->execute($params['email']);
        return ApiResponse::success($user, __("Get user successfully"));
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'phone' => 'nullable|regex:/^0[0-9]{9,10}$/|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|string|in:owner,lessee',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user
        ], 201);
    }

    // Đăng nhập và trả về token
    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required',
            'password' => 'required|string|min:6',
        ], [
            'email.required' => 'Vui lòng nhập Email hoặc Số điện thoại.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min' => 'Mật khẩu phải tối thiểu 6 ký tự',
        ]);

        $email = $fields['email'];
        $password = $fields['password'];

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $user = User::where('email', $email)->first();
        } else if (preg_match('/^0[0-9]{9,10}$/', $email)) {
            $user = User::where('phone', $email)->first();
        } else {
            return ApiResponse::error('Vui lòng nhập đúng định dạng Email hoặc Số điện thoại.', 400);
        }

        if (!$user) {
            return ApiResponse::error('Tài khoản không tồn tại.', 404);
        }

        if (!$token = auth()->attempt(['email' => $user->email, 'password' => $password])) {
            return response()->json([
                'success' => false,
                'errors' => [
                    'message' => ['Tài khoản hoặc mật khẩu không chính xác'],
                ]
            ], 401);
        }

        // Tạo token sử dụng JWT::fromUser()
        $token = JWTAuth::fromUser($user);

        $response = [
            'message' => 'login success',
            'data' => $this->createNewToken($token),
            'user' => $user,
        ];

        return response($response, 200);
    }

    public function loginSocial(Request $request)
    {
        $fields = $request->validate([
            'facebook_id' => 'required_without:google_id',
            'google_id' => 'required_without:facebook_id',
            'email' => 'required|email',
            'phone' => 'required_without:email|nullable|regex:/^0[0-9]{9,10}$/',
            'name' => 'nullable|string'
        ], [
            'facebook_id.required_without' => 'Vui lòng cung cấp Facebook ID.',
            'google_id.required_without' => 'Vui lòng cung cấp Google ID.',
            'email.required' => 'Vui lòng nhập Email.',
            'email.email' => 'Vui lòng nhập đúng định dạng Email.',
            'phone.required_without' => 'Vui lòng nhập Số điện thoại hoặc Email.',
            'phone.regex' => 'Số điện thoại không hợp lệ.',
        ]);

        // Tìm user theo social ID hoặc email
        $user = User::query()
            ->where('email', $fields['email'])
            ->orWhere('facebook_id', $fields['facebook_id'] ?? null)
            ->orWhere('google_id', $fields['google_id'] ?? null)
            ->first();

        if (!$user) {
            $user = User::create([
                'facebook_id' => $fields['facebook_id'] ?? null,
                'google_id' => $fields['google_id'] ?? null,
                'email' => $fields['email'],
                'name' => $fields['name'],
                'password' => bcrypt(Str::random(8))
            ]);

            $role = optional(Role::findByName('Viewer'));
            if ($role) {
                $user->assignRole($role);
            }
        } else {
            $user->update([
                'facebook_id' => $fields['facebook_id'] ?? $user->facebook_id,
                'google_id' => $fields['google_id'] ?? $user->google_id,
            ]);
        }

        // Tạo JWT token
        if (!$token = auth()->login($user)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Tạo refresh token
        $refreshToken = JWTAuth::getJWTProvider()->encode([
            'sub' => $user->id,
            'random' => rand() . time(),
            'exp' => time() + config('jwt.refresh_ttl'),
        ]);

        // Lấy danh sách role của user
        $roles = DB::table('model_has_roles')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->where('model_has_roles.model_id', $user->id)
            ->pluck('roles.name');

        return response()->json([
            'message' => 'Login successful',
            'token' => $this->createNewToken($token, $refreshToken),
            'user' => $user->toArray() + ['source' => $fields['facebook_id'] ? 'facebook' : 'google'],
            'roles' => $roles,
        ]);
    }

    protected function createNewToken($token)
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60, // thời gian sống của token
        ];
    }

    // Đăng xuất người dùng
    public function logout()
    {
        Auth::logout();
        session()->flush(); // Xóa toàn bộ session

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Validate dữ liệu đầu vào
        $validatedData = $request->validate([
            'name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:15',
            'age' => 'nullable|integer|min:1|max:150',
            'hometown' => 'nullable|string|max:255',
            'job' => 'nullable|string|max:255',
            'workplace' => 'nullable|string|max:255',
        ]);

        // Cập nhật thông tin user
        $user->update($validatedData);

        // Đăng xuất người dùng
        Auth::logout();

        return response()->json([
            'message' => 'Thông tin đã được cập nhật và đăng xuất thành công!',
            'user' => $user
        ]);
    }

    public function updateAvatar(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Validate dữ liệu đầu vào
        $validatedData = $request->validate([
            'avatar' => 'required|string',
        ]);

        $avatar = Common::uploadbase64Image($validatedData['avatar'], '/avatar');

        // Cập nhật thông tin user
        $user->update(['avatar' => Common::responseImage($avatar)]);

        // Đăng xuất người dùng
        Auth::logout();

        return response()->json([
            'message' => 'Thông tin đã được cập nhật và đăng xuất thành công!',
            'user' => $user
        ]);
    }
}
