<?php

namespace App\Services\Comment;

use App\Helpers\Common;
use App\Models\Notification;
use App\Repositories\Comment\CommentRepository;
use App\Services\Base\BaseServiceImp;
use App\Services\Comment\CommentService;
use Exception;
use Illuminate\Support\Facades\Log;
use Throwable;

class CommentServiceImp extends BaseServiceImp implements CommentService
{
    public function __construct(CommentRepository $commentRepository)
    {
        $this->repository = $commentRepository;
    }

    public function listCommentByPost(array $attribute): mixed
    {
        try {
            $comments = $this->repository->listCommentByPost($attribute);
            return $comments;
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }
    public function addComment(array $attribute): mixed
    {
        try {
            $data = [
                'user_id' => auth()->user()->id,
                'post_id' => $attribute['post_id'],
                'content' => $attribute['content'],
            ];
            $comments = parent::create($data);
            return $comments;
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }

    public function removeComment(array $attribute): mixed
    {
        try {
            $comments = $this->repository->listCommentByPost($attribute);
            return $comments;
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }
}