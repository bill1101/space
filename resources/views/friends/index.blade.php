@extends('layouts.main')
{{--@section('home'){{ '/'.$user->id }}@endsection--}}
{{--@section('blog'){{'#'}}@endsection--}}
{{--@section('photo'){{'#'}}@endsection--}}

@section('home'){{ '/'.$user->id }}@endsection
@section('blog'){{'/blog/'.$user->id}}@endsection
@section('photo'){{'/album/'.$user->id}}@endsection

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            @if($waiting->count())
                <h3>Waiting for response:</h3>
                @foreach($waiting as $user)
                    <p> {{$user->getName()}} </p>
                @endforeach
            @else
                <h4>No waiting requests</h4>
            @endif

            @if(!Auth::user()->friendRequests()->count())
                <h4>No request</h4>
            @else
                    <h3>Requests:</h3>
                @foreach(Auth::user()->friendRequests() as $user)
                    <div class="media well">
                        <div class="media-left media-middle col-md-3">
                            <a href="{{ Route('profile.index',['username'=>$user->name]) }}">
                                <img class="media-object" src="https://www.gravatar.com/avatar/{{ md5($user->email) }}?d=mm&s=80" alt="...">
                            </a>
                        </div>
                        <div class="media-body">
                            <a href="{{ Route('profile.index',['username'=>$user->name]) }}"><h4 class="media-heading">{{ $user->firstname }} {{ $user->lastname }}</h4>
                                {{ $user->name }}<br>{{ $user->location }}</a><br>
                            <a href="{{ Route('friends.accept',['name'=>$user->name]) }}" class="btn btn-primary btn-sm">Accept</a>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>



    <div class="row">
        @if(!$user->friends()->count())
            <div class="col-md-8 col-md-offset-2 well"><h3>No Friends</h3></div>
        @else
            <div class="col-md-8 col-md-offset-2">
                @foreach(Auth::user()->friends() as $user)
                <div class="col-md-6">
                    <div class="media well">
                        <div class="media-left media-middle col-md-4">
                            <a href="{{ Route('otherhome',['id'=>$user->id]) }}">
                                <img class="media-object" src="https://www.gravatar.com/avatar/{{ md5($user->email) }}?d=mm" alt="...">
                            </a>
                        </div>
                        <div class="media-body">
                            <a href="{{ Route('otherhome',['id'=>$user->id]) }}"><h4 class="media-heading">{{ $user->getName() }}</h4>
                                {{ $user->location }}</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection