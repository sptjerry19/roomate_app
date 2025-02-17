<?php

namespace App\Http\Controllers;

use App\Services\Comment\CommentService;
use Illuminate\Http\Request;

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

        $comments = $this->commentService->listCommentByPost($params);
    }
}