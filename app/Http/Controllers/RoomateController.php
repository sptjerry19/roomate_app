<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Helpers\Common;
use App\Http\Requests\PostRequest;
use App\Http\Resources\RoomateCollection;
use App\Http\Resources\RoomateResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RoomateController extends Controller
{
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
        ]);

        try {
            $keyword = $params['keyword'] ?? null;
            $area = $params['area'] ?? null;
            $price = $params['price'] ?? null;
            $district = $params['district'] ?? null;
            $type = $params['type'] ?? null;
            $limit = $request->input('limit', 10);

            $roomates = Post::query()
                ->when(!is_null($area), function ($query) use ($area) {
                    switch ($area) {
                        case 10:
                            return $query->where('area', '<=', 10);
                            break;

                        case 20:
                            return $query->where('area', '<=', 20)->where('area', '>=', 10);
                            break;

                        case 30:
                            return $query->where('area', '<=', 30)->where('area', '>=', 20);
                            break;

                        case 40:
                            return $query->where('area', '<=', 40)->where('area', '>=', 30);
                            break;

                        case 50:
                            return $query->where('area', '>=', 50);
                            break;

                        default:
                            return $query->where('area', '<=', $area);
                            break;
                    }
                })
                ->when(!is_null($price), function ($query) use ($price) {
                    return $query->where('price', '<', $price);
                })
                ->when(!is_null($district), function ($query) use ($district) {
                    return $query->where('district', 'like', '%' . $district . '%');
                })
                ->when(!is_null($keyword), function ($query) use ($keyword) {
                    return $query->where('title', 'like', '%' . $keyword . '%');
                })
                ->when(!is_null($type), function ($query) use ($type) {
                    return $query->where('type', $type);
                })
                ->orderByDesc('created_at')
                ->paginate($limit);

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

            // Lấy danh sách ảnh base64 từ yêu cầu
            $base64Images = $params['images'];

            // Upload ảnh base64
            $images = Common::uploadbase64Image($base64Images, '/room', true);

            // Biến chứa URL ảnh sau khi upload
            $uploadedImages = [];
            foreach ($images as $image) {
                // Xử lý và thêm URL ảnh đã upload vào mảng $uploadedImages
                $uploadedImages[] = Common::responseImage($image); // Giả sử responseImage trả về URL của ảnh
            }

            // Xem dữ liệu đã upload
            Log::info('Uploaded Images:', $uploadedImages);

            // Dữ liệu bài đăng
            $data = [
                'title' => $params['title'],
                'location' => $params['location'],
                'district' => $params['district'],
                'ward' => $params['ward'],
                'price' => $params['price'],
                'area' => $params['area'],
                'posted_by' => $params['posted_by'],
                'phone' => $params['phone'],
                'description' => $params['description'],
                'images' => $uploadedImages, // Lưu ảnh đã upload
                'type' => $params['type'],
                'status' => 'available',
            ];

            // Log dữ liệu để kiểm tra
            Log::info('Roommate data:', $data);

            // Tạo bài đăng
            $roomate = Post::create($data);

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
    public function update(Request $request, string $id)
    {
        try {
            // Xác thực dữ liệu
            $params = $request->validated();

            // Lấy danh sách ảnh base64 từ yêu cầu
            $base64Images = $params['images'];

            // Upload ảnh base64
            $images = Common::uploadbase64Image($base64Images, '/room', true);

            // Biến chứa URL ảnh sau khi upload
            $uploadedImages = [];
            foreach ($images as $image) {
                // Xử lý và thêm URL ảnh đã upload vào mảng $uploadedImages
                $uploadedImages[] = Common::responseImage($image); // Giả sử responseImage trả về URL của ảnh
            }

            // Xem dữ liệu đã upload
            Log::info('Uploaded Images:', $uploadedImages);

            // Dữ liệu bài đăng
            $data = [
                'title' => $params['title'],
                'location' => $params['location'],
                'district' => $params['district'],
                'ward' => $params['ward'],
                'price' => $params['price'],
                'area' => $params['area'],
                'posted_by' => $params['posted_by'],
                'phone' => $params['phone'],
                'description' => $params['description'],
                'images' => $uploadedImages, // Lưu ảnh đã upload
                'type' => $params['type'],
                'status' => 'available',
            ];

            // Log dữ liệu để kiểm tra
            Log::info('Roommate data:', $data);

            // Tạo bài đăng
            $roomate = Post::query()->findOrFail($id);
            $roomate->update($data);

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