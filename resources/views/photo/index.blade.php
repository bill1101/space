@extends('layouts.main')

@section('home'){{ '/'.$user->id }}@endsection
@section('blog'){{'/blog/'.$user->id}}@endsection
@section('photo'){{'/album/'.$user->id}}@endsection


@section('content')
    <h3>Accept user:{{ $user }}</h3>


    <div class="row">
        <div class="jumbotron col-md-8 col-md-offset-2 well bg_silver">
            <h1>{{$user['name']}}'s Photo Gallary</h1>
            <p> </p>
            {{--@if(Auth::user()->id==$user->id)--}}
                {{--<p><a class="btn btn-primary btn-lg" href="{{ url('album/'.$user->id.'/create') }}"></a></p>--}}
            {{--@endif--}}
        </div>

        <div class="col-md-8 col-md-offset-2 bg_lightgray">
            @foreach($photos as $photo)
                <div class="col-md-4">
                    <div class="well center">
                        <a href="{{ url('photo/'.$photo->id) }}"><img style="width: 90%" src="{{ url('photos/'.$photo->name) }}" alt="..."></a>
                        <div class="caption">
                            <a href="{{ url('photo/'.$photo->id) }}"><h3>{{ $photo->title }}</h3></a>
                            {{--<p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>--}}
                        </div>
                    </div>

                </div>
            @endforeach
        </div>
        @if(Auth::user()->id==$user->id)
        <div class="col-md-8 col-md-offset-2 well margin_top">
            <form action="{{ url('photos/'.$album_id.'/store') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <label>Title:</label>
                <input type="text" name="title" class="form-control" required maxlength="255">
                <label class="margin_top">Description:</label>
                <input type="text" name="description" class="form-control" maxlength="255">
                <label class="margin_top">Location:</label>
                <input type="text" name="location" class="form-control" maxlength="255">
                {{--<label class="margin_top">Name:</label>--}}
                {{--<input type="text" name="name" class="form-control" maxlength="255">--}}
                <label class="margin_top">Photo</label>
                <input type="file" name="photo">
                <input type="hidden" name="album_id" value="{{ $album_id }}">
                <input type="submit" value="Upload Photo" class="margin_top btn btn-primary">
            </form>
        </div>
        @endif
    </div>
@endsection