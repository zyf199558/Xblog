<?php
use App\Services\CategoryService;
use App\Services\CommentService;
use App\Services\PostService;
use App\Services\TagService;
use App\Services\ThemeService;

/**
 * Created by PhpStorm.
 * User: lufficc
 * Date: 2017/3/18
 * Time: 10:50
 */

if (!function_exists('get_posts')) {
    function get_posts($page_size = null)
    {
        return app(PostService::class)->getPosts($page_size);
    }
}

if (!function_exists('get_post')) {
    function get_post($slug)
    {
        return app(PostService::class)->getPost($slug);
    }
}

if (!function_exists('get_post_by_id')) {
    function get_post_by_id($id)
    {
        return app(PostService::class)->getPostById($id);
    }
}


if (!function_exists('get_post_by_id')) {
    function get_posts_by_tag($tag_name, $page_size = null)
    {
        return app(TagService::class)->getPosts($tag_name, $page_size);
    }
}

if (!function_exists('get_post_by_id')) {
    function get_posts_by_category($category_name, $page_size = null)
    {
        return app(CategoryService::class)->getPosts($category_name, $page_size);
    }
}

if (!function_exists('get_comments')) {
    function get_comments($commentable_type, $commentable_id)
    {
        return app(CommentService::class)->getByCommentable($commentable_type, $commentable_id);
    }
}

if (!function_exists('get_current_theme')) {
    function get_current_theme()
    {
        return app(ThemeService::class)->getCurrentTheme();
    }
}

if (!function_exists('get_config')) {
    function get_config($key, $default = null)
    {
        return app('XblogConfig')->getValue($key, $default);
    }
}

if (!function_exists('resource')) {
    function resource($path = '')
    {
        return '/' . get_current_theme()->name . '/' . $path;
    }
}