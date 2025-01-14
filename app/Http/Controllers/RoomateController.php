<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
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
        ]);

        try {
            $keyword = $params['keyword'] ?? null;
            $area = $params['area'] ?? null;
            $price = $params['price'] ?? null;
            $district = $params['district'] ?? null;

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
                    return $query->where('keyword', 'like', '%' . $keyword . '%');
                })
                ->get();
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
    public function destroy(string $id)
    {
        //
    }
}
