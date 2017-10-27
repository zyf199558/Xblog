<?php
/**
 * Created by PhpStorm.
 * User: lufficc
 * Date: 2016/10/5
 * Time: 0:00
 */

namespace App\Observers;


use App\Comment;
use App\Http\Controllers\Admin\FileableController;
use App\Notifications\ReceivedComment;

class CommentObserver
{
    protected $fileableController;

    public function __construct(FileableController $fileableController)
    {
        $this->fileableController = $fileableController;
    }

    public function saved(Comment $comment)
    {
        $this->fileableController->syncComment($comment);
    }

    public function created(Comment $comment)
    {
        if (!isAdminById($comment->user_id)) {
            getAdminUser()->notify(new ReceivedComment($comment));
        }
    }
}