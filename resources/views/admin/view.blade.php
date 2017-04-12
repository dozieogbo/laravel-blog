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
        <a href="{{route('admin.create.admin')}}" class="btn btn-block btn-primary">Add New Admin</a>
            @foreach($users as $user)
            <div class="post-preview">
                <a href="#">
                    <h2 class="post-title">
                        {{$user->name}}
                    </h2>
                    <h3 class="post-subtitle">
                        {{$user->email}}
                    </h3>
                </a>
            </div>
            <div>
                <ul class="list-inline text-center">
                    <li>
                        <a href="{{route('admin.edit.admin', ['id' => $user->id])}}">
                            <span class="fa-stack fa-lg">
                                <i class="fa fa-circle fa-stack-2x"></i>
                                <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('admin.delete.admin', ['id' => $user->id])}}">
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
            {{$users->links()}}
        </div>
    </div>
</div>

<hr>  
@endsection