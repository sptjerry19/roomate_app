<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Helpers\Common;
use App\Http\Requests\PostRequest;
use App\Http\Resources\RoomateCollection;
use App\Http\Resources\RoomateResource;
use App\Models\Post;
use App\Services\Roomate\RoomateService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use function PHPUnit\Framework\isEmpty;

class RoomateController extends Controller
{
    protected RoomateService $roomateService;
    public function __construct(RoomateService $roomateService)
    {
        $this->roomateService = $roomateService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $params = $request->validate([
            'keyword' => 'nullable|string',
            'area' => 'nullable|string',
            'price' => 'nullable|integer',
            'district' => 'nullable|string',
            'type' => 'nullable|string',
            'advertisement_type' => 'nullable|string',
        ]);

        try {
            $roomates = $this->roomateService->getRoomates($params);

            return ApiResponse::success(new RoomateCollection($roomates), 'Lấy danh sách Roomate thành công!');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ApiResponse::error('Lấy danh sách roomate thất bại!', 500);
        }
    }

    public function indexManage(Request $request)
    {
        $params = $request->validate([
            'keyword' => 'nullable|string',
            'area' => 'nullable|string',
            'price' => 'nullable|integer',
            'district' => 'nullable|string',
            'type' => 'nullable|string',
        ]);

        try {
            $user = auth()->user();
            if (!$user) {
                return ApiResponse::error('Người dùng chưa đăng nhập hoặc không hợp lệ!', 401);
            }

            $page = $request->input('page', 1);
            $limit = $request->input('limit', 10);

            $roomates = $this->roomateService->getRoomatesManager($params, $page, $limit);

            // Kiểm tra nếu không có dữ liệu
            if ($roomates->isEmpty()) {
                return ApiResponse::success([], 'Không có bài đăng nào.');
            }

            return ApiResponse::success(new RoomateCollection($roomates), 'Lấy danh sách Roomate thành công!');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ApiResponse::error('Lấy danh sách roomate thất bại!', 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        try {
            // Xác thực dữ liệu
            $params = $request->validated();

            $roomate = $this->roomateService->createRoomate($params);

            return ApiResponse::success(new RoomateResource($roomate), 'Tạo Roomate thành công!');
        } catch (\Exception $e) {
            Log::error('Error creating roommate post: ' . $e->getMessage());
            return ApiResponse::error('Tạo Roomate thất bại!', 500);
        }
    }

    public function registerAdvertiserment(Request $request)
    {
        // Lấy dữ liệu từ request
        $params = $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email',
            'type' => 'required|in:pop_up,banner,premium,common'
        ]);

        try {
            DB::beginTransaction();

            $userId = auth()->user()->id;

            $posts = Post::query()->where('user_id', $userId)->get();

            if (!isEmpty($posts)) {
                return ApiResponse::error('Bạn chưa đăng bài đăng nào!', 400);
            }

            foreach ($posts as $post) {
                $post->update(['advertisement_type' => $params['type']]);
            }

            DB::commit();
            return ApiResponse::success([], 'Đăng ký gói quảng cáo thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating roommate post: ' . $e->getMessage());
            return ApiResponse::error('Đăng ký gói quảng cáo thất bại!', 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $roommate = Post::query()->findOrFail($id);

            return ApiResponse::success(new RoomateResource($roommate), 'Lấy Roomate thành công!');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ApiResponse::error('Lấy danh sách roomate thất bại!', 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, string $id)
    {
        try {
            // Xác thực dữ liệu
            $params = $request->validated();

            $roomate = $this->roomateService->updateRoomate($params, $id);

            // Trả về kết quả thành công
            return ApiResponse::success(new RoomateResource($roomate), 'Tạo Roomate thành công!');
        } catch (\Exception $e) {
            // Ghi lại lỗi vào log
            Log::error('Error creating roommate post: ' . $e->getMessage());

            // Trả về lỗi
            return ApiResponse::error('Tạo Roomate thất bại!', 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $roommate = Post::query()->findOrFail($id);

            $roommate->delete();

            return ApiResponse::success([], 'Xóa Roomate thành công!');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ApiResponse::error('Xóa roomate thất bại!', 500);
        }
    }
}
