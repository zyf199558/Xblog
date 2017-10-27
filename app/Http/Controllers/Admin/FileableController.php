<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use App\File;
use App\Http\Controllers\Controller;
use App\Http\Repositories\CommentRepository;
use App\Http\Repositories\PageRepository;
use App\Http\Repositories\PostRepository;
use App\Page;
use App\Post;

class FileableController extends Controller
{
    protected $postRepository;
    protected $pageRepository;
    protected $commentRepository;


    public function __construct(PostRepository $postRepository,
                                PageRepository $pageRepository,
                                CommentRepository $commentRepository)
    {
        $this->postRepository = $postRepository;
        $this->pageRepository = $pageRepository;
        $this->commentRepository = $commentRepository;
    }

    public function syncAll()
    {
        $this->syncPosts();
        $this->syncPages();
        $this->syncComments();
    }

    public function syncPosts()
    {
        foreach (Post::withTrashed()->get() as $post) {
            $this->syncPost($post);
        }
    }

    public function syncPages()
    {
        foreach (Page::all() as $page) {
            $this->syncPage($page);
        }
    }


    public function syncComments()
    {
        foreach (Comment::withTrashed()->get() as $comment) {
            $this->syncComment($comment);
        }
    }

    public function syncPage(Page $page)
    {
        $this->sync($page, 'content');
    }

    public function syncComment(Comment $comment)
    {
        $this->sync($comment, 'content');
    }

    public function syncPost(Post $post)
    {
        $this->sync($post, ['content', 'description']);
    }

    public function sync($model, $fields)
    {
        $urls = [];
        if (is_array($fields)) {
            foreach ($fields as $field) {
                $this->urls($model->$field, $urls);
            }
        } elseif (is_string($fields)) {
            $this->urls($model->$fields, $urls);
        }
        $files = $this->fileIds($urls);
        $model->files()->sync($files);
    }

    public function urls($html_or_markdown, array &$urls)
    {
        $md_re = '/!\[.*?\]\((.*?)\)/';
        $html_re = '/<img[^>]+src="([^">]+)"/';
        $this->extractImageUrl($html_or_markdown, $md_re, $urls);
        $this->extractImageUrl($html_or_markdown, $html_re, $urls);
    }

    public function fileIds($urls)
    {
        return File::whereIn('url', $urls)->select('id')->get();
    }

    public function extractImageUrl($text, $re, array &$urls)
    {
        preg_match_all($re, $text, $matches, PREG_SET_ORDER);
        foreach ($matches as $match) {
            $url = $match[1];
            if (!in_array($url, $urls)) {
                array_push($urls, $url);
            }
        }
    }
}
