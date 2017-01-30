@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            @if($waiting->count())
                <h3>Waiting for response:</h3>
                @foreach($waiting as $user)
                <p> {{$user->getName()}} </p>
                @endforeach
            @else
                <h3>No waiting requests</h3>
            @endif
            <h3>Requests:</h3>
            @if(!Auth::user()->friendRequests()->count())
                <h4>No results</h4>
            @else
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

@endsection
