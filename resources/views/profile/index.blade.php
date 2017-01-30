@extends('layouts.main')
@section('home'){{ '/'.$user->id }}@endsection
@section('blog'){{'/blog/'.$user->id}}@endsection
@section('photo'){{'/album/'.$user->id}}@endsection
@section('content')
    <div class="row">
        <div class="col-md-2 col-md-offset-2">
            <div class="well">
                <img src="https://www.gravatar.com/avatar/{{ md5($user->email) }}?d=mm&s=80" alt="...">
            </div>
        </div>
        <div class="col-md-6">
                <div class="panel panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-heading">{{ $user->name }}'s profile:</div>

                    <!-- Table -->
                    <table class="table">
                        <tr><td>Username:</td><td>{{ $user->name }}</td></tr>
                        <tr><td>Email:</td><td>{{ $user->email }}</td></tr>
                        <tr><td>Firstname:</td><td>{{ $user->firstname }}</td></tr>
                        <tr><td>Lastname:</td><td>{{ $user->lastname }}</td></tr>
                        <tr><td>Location:</td><td>{{ $user->location }}</td></tr>
                        <tr><td>Birthday:</td><td>{{ $user->birthday }}</td></tr>
                        <tr><td>Phone:</td><td>{{ $user->phone }}</td></tr>
                        @if(Auth::user()==$user)
                        <tr><td><a href="{{ Route('profile.edit') }}" class="btn btn-primary btn-block">Update</a></td><td></td></tr>
                        @endif
                    </table>
                </div>
        </div>
    </div>

@endsection