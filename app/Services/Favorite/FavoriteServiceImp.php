<?php

namespace App\Services\Favorite;

use App\Helpers\Common;
use App\Models\Notification;
use App\Repositories\Favorite\FavoriteRepository;
use App\Services\Base\BaseServiceImp;
use App\Services\Favorite\FavoriteService;
use Exception;
use Illuminate\Support\Facades\Log;
use Throwable;

class FavoriteServiceImp extends BaseServiceImp implements FavoriteService
{
    public function __construct(FavoriteRepository $favoriteRepository)
    {
        $this->repository = $favoriteRepository;
    }
    // public function getFavorites($userId): mixed
    // {
    //     //
    // }
    public function addFavorite($roomId): mixed
    {
        try {
            $user = auth()->user();

            // Kiểm tra nếu $user không tồn tại
            if (!$user) {
                throw new \Exception("User not authenticated");
                return false;
            }

            // Kiểm tra nếu đã tồn tại post_id và user_id trong bảng favorites
            if ($user->favorites->contains($roomId)) {
                throw new \Exception("Post has already been added to favorites");
                return false;
            }

            // Thêm post_id và user_id vào bảng favorites
            $user->favorites()->attach($roomId);

            // Tạo thông báo
            Notification::create([
                'user_id' => $user->id, // Người đăng bài sẽ nhận thông báo
                'post_id' => $roomId,
                'title' => "Thêm thành công bài đăng vào danh sách quan tâm",
            ]);

            return true;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }

    public function removeFavorite($roomId): mixed
    {
        try {
            $user = auth()->user();

            // Kiểm tra nếu $user không tồn tại
            if (!$user) {
                throw new \Exception("User not authenticated");
                return false;
            }

            // Kiểm tra nếu đã tồn tại post_id và user_id trong bảng favorites
            if (!$user->favorites->contains($roomId)) {
                throw new \Exception("Post has not already been added to favorites");
                return false;
            }

            // Xóa post_id và user_id trong bảng favorites
            $user->favorites()->detach($roomId);

            return true;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }
}