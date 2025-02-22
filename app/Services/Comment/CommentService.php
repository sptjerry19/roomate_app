<?php

namespace App\Services\Comment;

use App\Services\Base\BaseServiceInterface;

interface CommentService extends BaseServiceInterface
{
    public function listCommentByPost(array $attribute): mixed;

    public function addComment(array $attribute): mixed;

    public function removeComment(array $atrribute): mixed;
}