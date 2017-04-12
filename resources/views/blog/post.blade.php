@extends('layouts.master') 
@section('header')
<header class="intro-header" style="background-image: url('{{URL::to($post->picurl)}}')">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <div class="post-heading">
                    <h1>{{$post->title}}</h1>
                    @if($post->summary != null)
                    <h2 class="subheading">{{$post->summary}}</h2>
                    @endif
                    <span class="meta">Posted by <a href="#">{{$post->user->name}}</a> on {{ $post->created_at->format('M d, Y, H:i')}}</span>
                    </br>
                    @foreach($post->tags as $tag)
                    <h2 class="label label-primary">{{$tag->name}}</h2>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</header>
@endsection 
@section('content')
<!-- Post Content -->
<article>
    <div class="container">
        <div class="row">
            <ul class="list-inline text-center">
                <li>
                    @if(count($has_liked) == 0)
                    <a class="" data-toggle="tooltip" href="{{route('blog.like', ['id' => $post->id])}}" title="Like post">
                        <span class="fa-stack fa-lg">
                            <i class="fa fa-circle fa-stack-2x"></i>
                            <i class="fa fa-thumbs-up fa-stack-1x fa-inverse"></i>
                        </span>
                    </a>
                    @else
                    <a class="" data-toggle="tooltip" href="{{route('blog.unlike', ['id' => $post->id])}}" title="Unlike post">
                        <span class="fa-stack fa-lg">
                            <i class="fa fa-circle fa-stack-2x"></i>
                            <i class="fa fa-thumbs-down fa-stack-1x fa-inverse"></i>
                        </span>
                    </a>
                    @endif
                    <span>{{count($post->likes)}} {{count($post->likes) == 1 ? 'Like' : 'Likes'}}</span>
                    <!--<ul>
                        @foreach($post->likes as $like)
                        <li>{{$like->user->name}}</li>
                        @endforeach
                    </ul>-->
                </li>
            </ul>
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                {!!$post->content!!}
            </div>
        </div>
    </div>
</article>

<hr>
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset">
        <h2 class="title">Comments</h2>
            <!-- Blog Comments -->
            <!-- Comments Form -->
            <div class="well">
                @if(Auth::check())
                <h4>Leave a Comment:</h4>
                <form role="form" role="form" method="post" action="{{route('blog.comment', ['id' => $post->id])}}">
                    {{csrf_field()}}
                    <div class="form-group">
                        <textarea class="form-control" rows="3" name="message"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                @else
                <h4>Please <a href="{{route('login')}}">login</a> to leave a comment</h4>
                @endif
            </div>
            <hr> @foreach($comments as $comment)
            <!-- Posted Comments -->
            <!-- Comment -->
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" src="{{URL::to('img/default-avatar.png')}}" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">{{$comment->user->name}}
                        <small>{{$comment->created_at->format('M d, Y')}} at {{$comment->created_at->format('h:i A')}}</small>
                    </h4>{{$comment->message}}

                    <div class="row">
                        <div class="col-md-12">
                            @if(Auth::check())
                            <a data-toggle="collapse" href="{{'#reply_box_'.$comment->id}}">
                                <span class="fa-stack fa-xs">
                                    <i class="fa fa-reply fa-stack-1x"></i>
                                </span>
                                <span style="font-size: 0.8em;">Reply</span>
                            </a>
                            @endif @if(count($comment->replies) > 0)
                            <a data-toggle="collapse" href="{{'#replies_'.$comment->id}}" class="" onclick="clicktoggleReply(this)">
                                <span style="font-size: 0.8em;">{{count($comment->replies)}} {{count($comment->replies) > 1 ? 'Replies' : 'Reply'}}</span>
                                <!--<span class="fa-stack fa-xs">
                                    <i class="fa fa-minus fa-stack-1x"></i>
                                </span>-->
                            </a>
                            @endif
                        </div>


                    </div>
                    @if(Auth::check())
                    <div class="collapse" id="{{'reply_box_'.$comment->id}}">
                        <form role="form" method="post" action="{{route('blog.comment', ['id' => $post->id])}}">
                            <div class="form-group">
                                {{csrf_field()}}
                                <input type="text" class="hidden" value="{{$comment->id}}" name="comment_id">
                                <textarea class="form-control" rows="3" name="message"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                    @endif
                    <div class="collapse" id="{{'replies_'.$comment->id}}">
                        @foreach($comment->replies as $reply)
                        <!-- Nested Comment -->
                        <div class="media" style="margin-top: 15px;">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="{{URL::to('img/default-avatar.png')}}" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">{{$reply->user->name}}
                                    <small>{{$reply->created_at->format('M d, Y')}} at {{$reply->created_at->format('h:i A')}}</small>
                                </h4>{{$reply->message}}
                            </div>
                        </div>
                        <!-- End Nested Comment -->
                        @endforeach
                    </div>

                </div>
            </div>
            @endforeach

        </div>
    </div>
</div>
</div>

<style>
    a:hover,
    a:focus {
        text-decoration: none;
    }
</style>
@endsection 
@section('scripts')
<script type="text/javascript">
    function clicktoggleReply(e) {
        var firstSpan = $($(e).children('span')[0]);
        var secondSpan = $($(e).children('span')[1]);

        if (firstSpan.text() == "Hide Replies") {
            //firstSpan.text("Show Replies");
            secondSpan.find('i').removeClass('fa fa-minus').addClass('fa fa-plus');
        } else {
            //firstSpan.text("Hide Replies");
            secondSpan.find('i').removeClass('fa fa-plus').addClass('fa fa-minus');
        }
    }
</script>
@endsection