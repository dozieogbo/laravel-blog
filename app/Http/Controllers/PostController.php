<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\DB;
use App\Post;

class PostController extends Controller
{
    public function Index(Store $session){
        $post = new Post();
        $posts = $post->getPosts($session);
        return view('blog.index', ['posts' => $posts]);
    }

    public function View(Store $session, $id){
        $post = new Post();
        $single_post = $post->getPost($session, $id);
        return view('blog.post', ['post' => $single_post]);
    }
}
