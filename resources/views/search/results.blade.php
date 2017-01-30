@extends('layouts.main')
@section('home'){{ '/'.$user->id }}@endsection
@section('blog'){{'/blog/'.$user->id}}@endsection
@section('photo'){{'/album/'.$user->id}}@endsection
@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h3>Results for {{ request('search') }}:</h3>
            @if(!$users->count())
                <h4>No results</h4>
            @else
                @foreach($users as $user)
                <div class="media well">
                    <div class="media-left media-middle col-md-3">
                        <a href="{{ Route('otherhome',['id'=>$user->id]) }}">
                            <img class="media-object" src="https://www.gravatar.com/avatar/{{ md5($user->email) }}?d=mm&s=80" alt="...">
                        </a>
                    </div>
                    <div class="media-body">
                        <a href="{{ Route('otherhome',['id'=>$user->id]) }}"><h4 class="media-heading">{{ $user->firstname }} {{ $user->lastname }}</h4>
                            {{ $user->name }}<br>{{ $user->location }}</a><br>
                        @if((Auth::user()->name != $user->name) && (!Auth::user()->isFriendWith($user)) && (!Auth::user()->hasFriendRequestPending($user)) && (!Auth::user()->hasFriendRequestReceived($user)))
                        <a href="{{ Route('friends.add',['username'=>$user->name]) }}" class="btn btn-primary btn-sm">Add Friend</a>
                        @endif
                    </div>
                </div>
                @endforeach
            @endif
        </div>


    </div>

@endsection
