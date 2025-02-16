<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Helpers\UploadImage;
use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UpdateRequest;
use App\Mail\ForgotPasswordVerificationMail;
use App\Mail\SendVerificationMail;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
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
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'refresh', 'forgotPassword', 'resetPassword', 'loginSocial', 'loginWithGoogle', 'checkVerification', 'checkVerificationRegister']]);
        $this->middleware(['role:Supper Admin|Admin|User management'])->only('userProfilebyId', 'listUsers', 'setTimeToken');

        // $this->googleClientService = $googleClientService;
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
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
}