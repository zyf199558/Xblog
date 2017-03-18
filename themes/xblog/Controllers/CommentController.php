<?php

namespace Themes\Xblog\Controllers;

use App\Comment;
use App\Http\Repositories\CommentRepository;
use App\Http\Requests;
use Gate;
use XblogConfig;

class CommentController extends Controller
{
    protected $commentRepository;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function edit(Comment $comment)
    {
        return view('comment.edit', compact('comment'));
    }

}
