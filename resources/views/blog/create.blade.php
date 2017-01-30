@extends('layouts.main')

@section('home'){{ '/'.Auth::user()->id }}@endsection
@section('blog'){{'/blog/'.Auth::user()->id}}@endsection
@section('photo'){{'/album/'.Auth::user()->id}}@endsection

@section('content')
<div class="row">
    <div class="jumbotron col-md-8 col-md-offset-2 well bg_silver">
        <h1>Create Blog</h1>
        <p> </p>

    </div>

    <div class="col-md-8 col-md-offset-2 well bg_silver">
        <form action="{{ url('blog/'.Auth::user()->id.'/create') }}" method="POST">
            {{ csrf_field() }}
            <label>Title:</label>
            <input type="text" name="title" class="form-control" required maxlength="255">
            <label class="margin_top">Category:</label>
            <select class="form-control" name="category_id">
                {{--@foreach($categories as $category)--}}
                    {{--<option value='{{ $category->id }}'>{{ $category->name }}</option>--}}
                {{--@endforeach--}}
            </select>
            <label class="margin_top">Blog:</label>
            <textarea name="blog" class="form-control textarea" rows="10"></textarea>

            <input type="submit" value="Post Blog" class="margin_top btn btn-primary">
        </form>
    </div>

</div>
@endsection