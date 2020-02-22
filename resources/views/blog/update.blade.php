@extends('layout')
@section('dashboard-content')

<h1>Update Blog Post</h1>

@if(Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="gone">
            <strong> {{ Session::get('success') }} </strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if(Session::get('failed'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert" id="gone">
            <strong> {{ Session::get('failed') }} </strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif


<form action="{{URL::to('update-blog-post')}}/{{$blogpost->id}}" method="post" enctype="multipart/form-data">
        
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1"> Blog Title</label>
            <input type="text" value="{{$blogpost->title}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter blog title name" name="blogTitle">
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1"> Blog details </label>
            <textarea class="form-control" id="editor1" name="blogDetail">{{ $blogpost->details }}</textarea>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">select category</label>
            <select class="form-control" name="category">
                <option> Select </option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}" 
                @if($category->id == $blogpost->category_id) selected @endif> {{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label>Select Featured Photo</label>
            <input type ="file" name="featuredPhoto" class="form-control" onchange="loadPhoto(event)">
        </div>

        <div class="float-right">
            <img id="photo" height="100" width="100" src="{{$blogpost->featured_image_url}}" style="margin:25px" onchange="loadPhoto(event)">
        </div>  

        <button type="submit" class="btn btn-primary my-2">Update</button>
    </form>

    
    <script>
        function loadPhoto(event) {
            var reader = new FileReader();
            reader.onload = function () {
                var output = document.getElementById('photo');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>


@stop

