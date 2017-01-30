@extends('layouts.main')

@section('home'){{ '/'.Auth::user()->id }}@endsection
@section('blog'){{'/blog/'.Auth::user()->id}}@endsection
@section('photo'){{'/album/'.Auth::user()->id}}@endsection

@section('content')
    <div class="row">
        <div class="jumbotron col-md-8 col-md-offset-2 well bg_silver">
            <h1>Create Album</h1>
            <p> </p>

        </div>

        <div class="col-md-8 col-md-offset-2 well bg_silver">
            <form action="{{ url('album/'.Auth::user()->id.'/create') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <label>Title:</label>
                <input type="text" name="name" class="form-control" required maxlength="255">
                <label class="margin_top">Description:</label>
                <input type="text" name="description" class="form-control" maxlength="255">
                <label class="margin_top">Cover</label>
                <input type="file" name="cover">
                <input type="submit" value="Create Album" class="margin_top btn btn-primary">
            </form>
        </div>

    </div>
@endsection