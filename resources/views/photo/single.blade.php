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
            <div class="center margin_top">
                <img style="width: 90%" src="{{ url('photos/'.$photo->name) }}" alt="...">
                <div class="caption">
                    <h3>{{ $photo->title }}</h3>
                    {{--<p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>--}}
                </div>
            </div>
            <div class="margin_top center">
                <a href="javascript:history.back()"><h3>Back</h3></a>
            </div>
        </div>
    </div>
@endsection