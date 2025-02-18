<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Models\Comment;
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

    public function createComment(Request $request)
    {
        $params = $request->validate([
            'post_id' => 'required|integer',
            'content' => 'required|string',
        ]);

        try {
            $data = [
                'user_id' => auth()->user()->id,
                'post_id' => $params['post_id'],
                'content' => $params['content'],
            ];

            $comments = Comment::create($data);
            if (!$comments) {
                return ApiResponse::error(__('Tạo comment thất bại!'), 500);
            }

            return ApiResponse::success($comments, __('Tạo comment thành công!'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ApiResponse::error(__('Tạo comment thất bại!'), 500);
        }
    }

    public function updateComment(Request $request, string $id)
    {
        $params = $request->validate([
            'post_id' => 'required|integer',
            'content' => 'required|string',
        ]);

        try {
            $data = [
                'user_id' => auth()->user()->id,
                'post_id' => $params['post_id'],
                'content' => $params['content'],
            ];
            $comments = $this->commentService->update($id, $data);

            return ApiResponse::success($comments, __('Lấy danh sách comment thành công!'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ApiResponse::error(__('Lấy danh sách comment thất bại!'), 500);
        }
    }

    public function deleteComment(Request $request)
    {
        $params = $request->validate([
            'post_id' => 'required|integer',
        ]);

        try {
            $data = [
                'user_id' => auth()->user()->id,
                'post_id' => $params['post_id'],
                'content' => $params['content'],
            ];
            $comments = $this->commentService->create($data);

            return ApiResponse::success($comments, __('Lấy danh sách comment thành công!'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ApiResponse::error(__('Lấy danh sách comment thất bại!'), 500);
        }
    }
}