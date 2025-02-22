<?php

namespace App\Repositories\Comment;

use App\Models\Comment;
use App\Repositories\Base\BaseRepository;

class CommentRepositoryEloquent extends BaseRepository implements CommentRepository
{
    public function getModel(): string
    {
        return Comment::class;
    }

    public function listCommentByPost(array $attribute): mixed
    {
        return $this->select()
            ->where('post_id', $attribute['post_id'])
            ->get();
    }
}