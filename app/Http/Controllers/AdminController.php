<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Session\Store;
use App\Post;

class AdminController extends Controller
{
    public function Index(Store $session){
        $post = new Post();
        $posts = $post->getPosts($session);
        return view('admin.index', ['posts' => $posts]);
    }

    public function Create(Store $session, Request $request){
        $this->validate($request, [
            'title' => 'required|min:10',
            'content' => 'required'
        ]);
        $post = new Post();
        $newPost = [
            'title' => $request->input('title'),
            'subtitle' => $request->input('subtitle'),
            'content' => $request->input('content')
        ];
        $post->addPost($session, $newPost);
        return redirect()->route('admin.create')->with('info','Creation of post was successful');
    }

    public function Edit(Store $session, $id){
        $post = new Post();
        $single_post = $post->getPost($session, $id);
        return view('admin.edit', ['post' => $single_post, 'id' => $id]);
    }

    public function Update(Store $session, Request $request){
        $post = new Post();
        $newPost = [
            'id' => $request->input('id') - 1,
            'title' => $request->input('title'),
            'subtitle' => $request->input('subtitle'),
            'content' => $request->input('content')
        ];
        $post->editPost($session, $newPost);
        return redirect()->route('blog.index');
    }
}
