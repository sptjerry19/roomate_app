<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
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
                    return $query->where('area', '<=', $area);
                })
                ->when(!is_null($price), function ($query) use ($price) {
                    return $query->where('price', '<=', $price);
                })
                ->when(!is_null($district), function ($query) use ($district) {
                    return $query->where('district', $district);
                })
                ->when(!is_null($keyword), function ($query) use ($keyword) {
                    return $query->where('title', 'like', '%' . $keyword . '%');
                })
                ->when(!is_null($type), function ($query) use ($type) {
                    return $query->where('type', $type);
                })
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
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
