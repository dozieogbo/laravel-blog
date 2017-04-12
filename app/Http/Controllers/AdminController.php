<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Post;
use App\Tag;
use App\User;

class AdminController extends Controller
{
    public function Index(){
        $posts = Post::with('tags', 'user')->paginate(5);
        return view('admin.index', ['posts' => $posts]);
    }

    public function getPostsJSON(){
        $posts = Post::all();
        return response()->json($posts);
    }

    public function Create(){
        $tags = Tag::all();
        return view('admin.create', ['tags' => $tags]);
    }

    public function PostCreate(Store $session, Request $request){
        $this->validate($request, [
            'title' => 'required|min:10',
            'content' => 'required'
        ]);
        $post = new Post([
            'title' => $request->input('title'),
            'summary' => $request->input('subtitle'),
            'content' => $request->input('content'),
            'picurl' => 'img/home-bg.jpg',
            'author' => Auth::id()
        ]);
        $post->save();
        $tags = $request->input('tags');
        $post->tags()->attach($tags === null ? [] : $tags);
        return redirect()->route('admin.index')->with('info','Creation of post was successful');
    }

    public function Edit($id){
        $tags = Tag::all();
        $single_post = Post::find($id);
        return view('admin.edit', ['post' => $single_post, 'id' => $id, 'tags' => $tags]);
    }

    public function Update(Request $request){
        $post = Post::find($request->input('id'));
        $post->title = $request->input('title');
        $post->summary = $request->input('summary');
        $post->content = $request->input('content');
        $post->save();
        $tags = $request->input('tags');
        $post->tags()->sync($tags === null ? [] : $tags);
        return redirect()->route('admin.index')->with('info','Post update successful');
    }

    public function Delete($id){
        $post = Post::find($id);
        //Delete One-To-Many
        $post->likes()->delete();
        //Delete Many-To-Many
        $post->tags()->detach();
        $post->delete();
        return redirect()->route('admin.index')->with('info','Post delete successful');
    }

    public function AddAdmin(Request $request){
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users'
        ]);
        $user = new User([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt('12admin345'),
            'role' => 'admin'
        ]);
        $user->save();
        return redirect()->route('admin.view')->with('info', 'Admin created successfully');
    }

    public function ViewAdmin(){
        $admins = User::where('role', '=', 'admin')->paginate(3);
        return view('admin.view', ['users' => $admins]);
    }

    public function EditAdmin($id){
        $user = User::find($id);
        return view('admin.editadmin', ['user' => $user, 'id' => $id]);
    }

    public function UpdateAdmin(Request $request){
        $user = User::find($request->input('id'));
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();
        return redirect()->route('admin.view')->with('info','Admin update successful');
    }

    public function DeleteAdmin($id){
        $user = User::find($id);
        $user->delete();
        return redirect()->route('admin.view')->with('info','Admin delete successful');
    }
}
