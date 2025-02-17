<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Services\Comment\CommentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CommentController extends Controller
{
    private $commentService;
    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    public function listCommentByPost(Request $request)
    {
        $params = $request->validate([
            'post_id' => 'required|integer',
            'page' => 'nullable|integer',
            'limit' => 'nullable|integer',
        ]);

        try {
            $comments = $this->commentService->listCommentByPost($params);

            return ApiResponse::success($comments, __('Lấy danh sách comment thành công!'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ApiResponse::error(__('Lấy danh sách comment thất bại!'), 500);
        }
    }
}