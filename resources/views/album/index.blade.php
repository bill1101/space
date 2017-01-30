@extends('layouts.main')

@section('home'){{ '/'.$user->id }}@endsection
@section('blog'){{'/blog/'.$user->id}}@endsection
@section('photo'){{'/album/'.$user->id}}@endsection


@section('content')



    <div class="row">
        <div class="jumbotron col-md-8 col-md-offset-2 well bg_silver">
            <h1>{{$user['name']}}'s Photo Gallary</h1>
            <p> </p>
            @if(Auth::user()->id==$user['id'])
                <p><a class="btn btn-primary btn-lg" href="{{ url('album/'.$user['id'].'/create') }}">Create new Album</a></p>
            @endif
        </div>

        <div class="col-md-8 col-md-offset-2">
            @foreach($albums as $album)
            <div class="col-md-4">
                <div class="well center">
                        <a href="{{ url('photos/'.$album->id) }}"><img style="width: 90%" src="{{ url('photos/'.$album->cover) }}" alt="..."></a>
                        <div class="caption">
                            <a href="{{ url('photos/'.$album->id) }}"><h3>{{ $album->name }}</h3></a>
                            {{--<p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>--}}
                        </div>
                </div>

            </div>
            @endforeach
        </div>



    </div>





@endsection