<?php

namespace App\Services\Roomate;

use App\Helpers\Common;
use App\Repositories\Roomate\RoomateRepository;
use App\Services\Base\BaseServiceImp;
use Exception;
use Illuminate\Support\Facades\Log;

class RoomateServiceImp extends BaseServiceImp implements RoomateService
{
    public function __construct(RoomateRepository $roomateRepository)
    {
        $this->repository = $roomateRepository;
    }

    public function getRoomates(array $params): mixed
    {
        try {
            return $this->repository->getRoomates($params);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }

    public function getRoomatesManager(array $params, ?int $page, ?int $limit): mixed
    {
        try {
            return $this->repository->getRoomatesManager($params, $page, $limit);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }

    public function createRoomate(array $attributes): mixed
    {
        try {
            // Lấy danh sách ảnh base64 từ yêu cầu
            $base64Images = $attributes['images'];

            // Upload ảnh base64
            $images = Common::uploadbase64Image($base64Images, '/room', true);

            // Biến chứa URL ảnh sau khi upload
            $uploadedImages = [];
            foreach ($images as $image) {
                // Xử lý và thêm URL ảnh đã upload vào mảng $uploadedImages
                $uploadedImages[] = Common::responseImage($image); // Giả sử responseImage trả về URL của ảnh
            }

            // Dữ liệu bài đăng
            $data = [
                'title' => $attributes['title'],
                'location' => $attributes['location'],
                'district' => $attributes['district'],
                'ward' => $attributes['ward'],
                'price' => $attributes['price'],
                'area' => $attributes['area'],
                'posted_by' => $attributes['posted_by'],
                'phone' => $attributes['phone'],
                'description' => $attributes['description'],
                'images' => $uploadedImages, // Lưu ảnh đã upload
                'type' => $attributes['type'],
                'advertisement_type' => $attributes['advertisement_type'],
                'user_id' => auth()->user()->id ?? null, // Lưu ID người đăng
                'status' => 'available',
            ];

            // Tạo bài đăng
            $roomate = parent::create($data);
            return $roomate;
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }

    public function updateRoomate(array $attributes, int $id): mixed
    {
        try {
            // Lấy danh sách ảnh base64 từ yêu cầu
            $base64Images = $attributes['images'];

            // Upload ảnh base64
            $images = Common::uploadbase64Image($base64Images, '/room', true);

            // Biến chứa URL ảnh sau khi upload
            $uploadedImages = [];
            foreach ($images as $image) {
                // Xử lý và thêm URL ảnh đã upload vào mảng $uploadedImages
                $uploadedImages[] = Common::responseImage($image); // Giả sử responseImage trả về URL của ảnh
            }

            // Dữ liệu bài đăng
            $data = [
                'title' => $attributes['title'],
                'location' => $attributes['location'],
                'district' => $attributes['district'],
                'ward' => $attributes['ward'],
                'price' => $attributes['price'],
                'area' => $attributes['area'],
                'posted_by' => $attributes['posted_by'],
                'phone' => $attributes['phone'],
                'description' => $attributes['description'],
                'images' => $uploadedImages, // Lưu ảnh đã upload
                'type' => $attributes['type'],
                'user_id' => auth()->user()->id ?? null, // Lưu ID người đăng
                'status' => 'available',
            ];

            $roomate = parent::update($id, $data);

            return $roomate;
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }
}
