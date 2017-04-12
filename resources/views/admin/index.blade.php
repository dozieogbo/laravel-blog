@extends('layouts.master')
@section('content')
<!-- Main Content -->
<div class="container">
    @if(Session::has('info'))
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
            <div class="alert alert-success alert-dismissible show"  role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <span>{{Session::get('info')}}</span>
            </div>
        </div>
    </div>
    @endif
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
        <a href="{{route('admin.create')}}" class="btn btn-block btn-primary">Add New Post</a>
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
            <div>
                <ul class="list-inline text-center">
                    <li>
                        <a data-toggle="tooltip" title="Edit Post" href="{{route('admin.edit', ['id' => $post->id])}}">
                            <span class="fa-stack fa-lg">
                                <i class="fa fa-circle fa-stack-2x"></i>
                                <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a data-toggle="tooltip" title="Delete Post" href="{{route('admin.delete', ['id' => $post->id])}}">
                            <span class="fa-stack fa-lg">
                                <i class="fa fa-circle fa-stack-2x"></i>
                                <i class="fa fa-trash fa-stack-1x fa-inverse"></i>
                            </span>
                        </a>
                    </li>
                </ul>
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