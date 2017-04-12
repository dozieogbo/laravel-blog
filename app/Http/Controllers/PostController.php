<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Post;
use App\Like;
use App\Comment;

class PostController extends Controller
{
    public function Index()
    {
        $posts = Post::paginate(5);
        return view('blog.index', ['posts' => $posts]);
    }

    public function View($id)
    {
        $single_post = Post::find($id);
        $comments = $single_post->comments()->where('comment_id', null)->with('replies')->get();
        $has_liked = $single_post->likes()->where('user_id', Auth::id())->get();
        return view('blog.post', ['post' => $single_post, 'comments' => $comments, 'has_liked' => $has_liked]);
    }

    public function Like($id)
    {
        $post = Post::find($id);
        $like = new Like(['user_id' => Auth::id()]);
        $post->likes()->save($like);
        return redirect()->route('blog.post', ['id' => $id]);
    }

    public function UnLike($id)
    {
        $post = Post::find($id);
        $post->likes()->where('user_id', Auth::id())->delete();
        return redirect()->route('blog.post', ['id' => $id]);
    }

    public function Comment(Request $request, $id)
    {
        $post = Post::find($id);
        $comment = new Comment([
            'user_id' => Auth::id(),
            'comment_id' => $request->input('comment_id'),
            'message' => $request->input('message')
            ]);
        $post->comments()->save($comment);
        return redirect()->route('blog.post', ['id' => $id]);
    }

    public function PostContact(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'content' => 'required',
            'email' => 'required',
            'number' => 'required'
        ]);
        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'content' => $request->input('content'),
            'number' => $request->input('number')
        ];

        Mail::send('emails.contact', $data, function ($message) use ($data) {
            $message->from($data['email'], $data['name']);

            $message->to('presleydozy@gmail.com', 'Dozie')->subject('Feedack Form from Blog by '.$data['name']);
        });

        return redirect()->route('others.contact')->with('info', 'Your feedback was sent successfully');
    }
}
