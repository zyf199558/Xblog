<?php
/**
 * Created by PhpStorm.
 * User: lufficc
 * Date: 2017/3/19
 * Time: 13:35
 */

namespace App\Http\Controllers;


class XblogController extends Controller
{
    public function index()
    {
        $posts = get_posts(10);
        return view('index', compact('posts'));
    }

    public function postByTag($name)
    {
        $posts = get_posts_by_tag($name, 10);
        return view('index', compact('posts'));
    }

    public function post($slug)
    {
        $post = get_post($slug);
        $recommendedPosts = get_recommended_posts($post);
        return view('post', compact('post', 'recommendedPosts'));
    }

    public function page($name)
    {
        $page = get_page($name);
        return view('page', compact('page'));
    }

    public function tags()
    {
        $tags = get_tags();
        return view('tags', compact('tags'));
    }

    public function achieves()
    {
        $posts = get_all_posts();
        return view('achieves', compact('posts'));
    }
}