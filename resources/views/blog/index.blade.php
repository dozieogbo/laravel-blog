@extends('layouts.master')
@section('content')
<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
            @foreach($posts as $post)
            <div class="post-preview">
                <a href="{{route('blog.post', ['id'=> $post->id])}}">
                    <h2 class="post-title">
                        {{$post->title}}
                    </h2>
                    <h3 class="post-subtitle">
                        {{$post->summary}}
                    </h3>
                </a>
                <p class="post-meta">Posted by <a href="#">{{$post->user->name}}</a> on {{$post->created_at->format('M d, Y, H:i')}}</p>
                @foreach($post->tags as $tag)
                <span class="label label-default">{{$tag->name}}</span>
                @endforeach
            </div>
            <hr>
            @endforeach
            <!-- Pager -->
            {{$posts->links()}}
        </div>
    </div>
</div>

<hr>  
@endsection
