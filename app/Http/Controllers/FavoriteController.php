<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Resources\RoomateCollection;
use App\Models\Post;
use App\Services\Favorite\FavoriteService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FavoriteController extends Controller
{
    private $favoriteService;
    public function __construct(FavoriteService $favoriteService)
    {
        $this->favoriteService = $favoriteService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $user = auth()->user();
            $favorite = $user->favorites;

            return ApiResponse::success(new RoomateCollection($favorite), 'Xem danh sách yêu thích thành công!');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ApiResponse::error('Xem danh sách yêu thích thất bại!', 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $params = $request->validate([
            'post_id' => 'required|integer',
        ]);

        try {
            $post = Post::findOrFail($params['post_id']);

            $favorite = $this->favoriteService->addFavorite($post->id);

            if (!$favorite) {
                return ApiResponse::error('Thêm yêu thích thất bại!', 500);
            }

            return ApiResponse::success([], 'Thêm yêu thích thành công!');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Lỗi bài viết không tồn tại
            Log::error($e->getMessage());
            return ApiResponse::error('Bài viết không tồn tại!', 404);
        } catch (\Exception $e) {
            // Đọc lỗi từ exception và trả về thông báo tương ứng
            $errorMessage = $e->getMessage();
            Log::error($errorMessage);

            if ($errorMessage === "User not authenticated") {
                return ApiResponse::error('Người dùng chưa đăng nhập!', 401);
            }

            if ($errorMessage === "Post has already been added to favorites") {
                return ApiResponse::error('Bài viết đã được thêm vào yêu thích trước đó!', 400);
            }

            // Lỗi không xác định
            return ApiResponse::error('Thêm yêu thích thất bại!', 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function remove(Request $request)
    {
        $params = $request->validate([
            'post_id' => 'required|integer',
        ]);

        try {
            $post = Post::findOrFail($params['post_id']);

            $favorite = $this->favoriteService->removeFavorite($post->id);

            if (!$favorite) {
                return ApiResponse::error('Xóa yêu thích thất bại!', 500);
            }

            return ApiResponse::success([], 'Xóa yêu thích thành công!');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Lỗi bài viết không tồn tại
            Log::error($e->getMessage());
            return ApiResponse::error('Bài viết không tồn tại!', 404);
        } catch (\Exception $e) {
            // Đọc lỗi từ exception và trả về thông báo tương ứng
            $errorMessage = $e->getMessage();
            Log::error($errorMessage);

            if ($errorMessage === "User not authenticated") {
                return ApiResponse::error('Người dùng chưa đăng nhập!', 401);
            }

            if ($errorMessage === "Post has already been added to favorites") {
                return ApiResponse::error('Bài viết đã được Xóa trước đó!', 400);
            }

            // Lỗi không xác định
            return ApiResponse::error('Xóa yêu thích thất bại!', 500);
        }
    }
}