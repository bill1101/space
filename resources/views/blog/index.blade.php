@extends('layouts.main')

@section('home'){{ '/'.$user->id }}@endsection
@section('blog'){{'/blog/'.$user->id}}@endsection
@section('photo'){{'/album/'.$user->id}}@endsection


@section('content')
    {{----<h3>Accept user:{{ $user }} Blog page</h3>----}}
    <div class="row">
        <div class="jumbotron col-md-8 col-md-offset-2 well bg_silver">
            <h1>{{$user['name']}}'s blog</h1>
            <p> </p>
            @if(Auth::user()->id==$user['id'])
            <p><a class="btn btn-primary btn-lg" href="{{ url('blog/'.$user['id'].'/create') }}">Create new blog</a></p>
                @endif
        </div>


        <div class="col-md-8 col-md-offset-2 well bg_silver">
            @foreach($blogs as $blog)
            <div>
                <h2>{{ $blog->title }}</h2>
                <h5>{{ $blog->created_at }}</h5>
                {{--<p>{{ substr($post->body,0,250) }}{{ strlen($post->body)>250?'...':"" }}</p>--}}
                <p>{{ $blog->blog }}</p>
                {{--<a href="{{ route('blog.index', $user['id']) }}" class="btn btn-primary">Read More</a>--}}
                <hr>
            </div>
            @endforeach

                <div class="center">
                    {{ $blogs->links() }}
                </div>
        </div>


    </div>
@endsection