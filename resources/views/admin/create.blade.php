@extends('layouts.master')
@section('content')
  <div class="container">
    @if(count($errors) > 0)
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-danger alert-dismissible show"  role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                
                <span>{{ join(', ', $errors->all())}}</span>
            </div>
        </div>
    </div>
    @endif
    @if(Session::has('info'))
    <div class="row">
        <div class="col-md-12">
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
        <div class="col-md-12">
            <form action="{{route('admin.create')}}" class="" method="post">
                <div class="form-group">
                    <label class="control-label">Title</label>
                    <input type="text" class="form-control" placeholder="Title" name = "title">
                </div>
                <div class="form-group">
                    <label class="control-label">Subtitle/Caption</label>
                    <input type="text" class="form-control" placeholder="A short summary of your post" name = "subtitle">
                </div>
                <div class="form-group">
                    <label class="control-label">Content</label>
                    <textarea class="form-control" placeholder="Content" id="textarea" name = "content"></textarea>
                </div>
                {{csrf_field()}}
                <button class="btn btn-primary btn-block" type="submit">Save</button>
            </form>
        </div>
    </div>
</div>  
@endsection
@section('scripts')
    <script src="{{URL::to('js/tinymce/tinymce.min.js')}}"></script>
    <script type="text/javascript">
    tinymce.init({
        selector: 'textarea',
        height: 300,
        menubar: false,
        plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table contextmenu paste code'
        ],
        toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image'
    });
    </script>
@endsection