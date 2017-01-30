@extends('layouts.main')
@section('home'){{ '/'.$user->id }}@endsection
@section('blog'){{'/blog/'.$user->id}}@endsection
@section('photo'){{'/album/'.$user->id}}@endsection
@section('content')
    <div class="row">
        <div class="col-md-2 col-md-offset-2">
            <div class="well">
                <img src="https://www.gravatar.com/avatar/{{ md5(Auth::user()->email) }}?d=mm&s=80" alt="...">
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading">{{ Auth::user()->name }}'s profile:</div>
                <form action="{{ route('profile.edit') }}" method="POST">
                    {{ csrf_field() }}
                <table class="table">
                    <tr><td>Username:</td><td><input type="text" name="name" value="{{ Request::old('name')?:Auth::user()->name }}"></td></tr>
                    <tr><td>Email:</td><td><input type="text" name="email" value="{{ Request::old('email')?:Auth::user()->email }}"></td></tr>
                    <tr><td>Firstname:</td><td><input type="text" name="firstname" value="{{ Request::old('firstname')?:Auth::user()->firstname }}"></td></tr>
                    <tr><td>Lastname:</td><td><input type="text" name="lastname" value="{{ Request::old('lastname')?:Auth::user()->lastname }}"></td></tr>
                    <tr><td>Location:</td><td><input type="text" name="location" value="{{ Request::old('location')?:Auth::user()->location }}"></td></tr>
                    <tr><td>Birthday:</td><td><input type="text" name="birthday" value="{{ Request::old('birthday')?:Auth::user()->birthday }}"></td></tr>
                    <tr><td>Phone:</td><td><input type="text" name="phone" value="{{ Request::old('phone')?:Auth::user()->phone }}"></td></tr>
                    <tr><td><input type="submit" class="btn btn-block btn-primary" value="Update"></td><td></td></tr>
                </table>
                </form>
            </div>
        </div>
    </div>

@endsection