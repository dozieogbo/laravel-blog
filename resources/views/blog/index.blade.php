@extends('layouts.master')
@section('content')
<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
            @foreach($posts as $post)
            <div class="post-preview">
                <a href="{{route('blog.post', ['id'=> array_search($post, $posts) + 1])}}">
                    <h2 class="post-title">
                        {{$post['title']}}
                    </h2>
                    <h3 class="post-subtitle">
                        {{$post['subtitle']}}
                    </h3>
                </a>
                <p class="post-meta">Posted by <a href="#">{{$post['author']}}</a> on {{$post['date']}}</p>
            </div>
            <hr>
            @endforeach
            <!-- Pager -->
            <ul class="pager">
                <li class="next">
                    <a href="#">Older Posts &rarr;</a>
                </li>
                
                <li class="previous">
                    <a href="#">&larr; Newer Posts</a>
                </li>
            </ul>
        </div>
    </div>
</div>

<hr>  
@endsection
