<?php

namespace App\Repositories\Comment;

use App\Repositories\Base\RepositoryInterface;

interface CommentRepository extends RepositoryInterface
{
    /**
     * @return string
     */
    public function getModel(): string;

    public function listCommentByPost(array $attribute): mixed;
}