<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Helpers\Common;
use App\Models\Motor;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class MotorController extends Controller
{
    /**
     * Chuyển đổi đối tượng phân trang thành mảng meta theo định dạng đã cho.
     *
     * @param  mixed  $collection  Đối tượng phân trang (ví dụ: LengthAwarePaginator)
     * @return array|null
     */
    public static function collectionPagination($collection): ?array
    {
        try {
            return [
                'total'        => $collection->total(),
                'count'        => $collection->count(),
                'per_page'     => $collection->perPage(),
                'current_page' => $collection->currentPage(),
                'last_page'    => $collection->lastPage()
            ];
        } catch (Exception $e) {
            return null;
        }
    }
    // Lấy tất cả dữ liệu
    public function index()
    {
        $motors = Motor::query()->orderByDesc('id')->paginate(10);

        // Tạo mảng chứa thông tin phân trang
        $pagination = self::collectionPagination($motors);

        // Trả về kết quả JSON với dữ liệu và meta phân trang
        return response()->json([
            'status'     => 'success',
            'message'    => 'Lấy dữ liệu thành công!',
            'data'       => $motors->items(),
            'pagination' => $pagination
        ], 200);
    }

    // Lưu dữ liệu mới
    public function store(Request $request)
    {
        $request->validate([
            'data' => 'required|array',
            'data.*.time' => 'required|integer',
            'data.*.speed' => 'required|numeric',
            'data.*.distance' => 'required|numeric',
        ]);

        // Tạo tên motor: random string + ngày giờ hiện tại (định dạng YmdHis)
        $name = Str::random(8) . '_' . now()->format('YmdHis');

        $data = [
            'name' => $name,
            'data' => $request->input('data')
        ];

        $motor = Motor::create($data);

        return ApiResponse::success($motor, 'Thêm dữ liệu thành công!');
    }

    // Lấy một bản ghi theo ID
    public function show($id)
    {
        $motor = Motor::findOrFail($id);
        return ApiResponse::success($motor, 'Lấy dữ liệu thành công!');
    }

    // Cập nhật dữ liệu
    public function update(Request $request, $id)
    {
        $request->validate([
            'data' => 'required|array',
            'data.*.time' => 'required|integer',
            'data.*.speed' => 'required|numeric',
            'data.*.distance' => 'required|numeric',
        ]);

        $motor = Motor::findOrFail($id);
        $motor->update(['data' => $request->input('data')]);

        return response()->json(['message' => 'Data updated successfully']);
    }

    // Xóa một bản ghi
    public function destroy($id)
    {
        Motor::destroy($id);
        return response()->json(['message' => 'Data deleted successfully']);
    }
}
