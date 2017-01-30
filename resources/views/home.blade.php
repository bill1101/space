@extends('layouts.main')

@section('home'){{ '/'.$user->id }}@endsection
@section('blog'){{'/blog/'.$user->id}}@endsection
@section('photo'){{'/album/'.$user->id}}@endsection


@section('content')
<!--<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>-->
<div class="row">
    <div class="page-header col-lg-8 col-md-offset-2 well-lg bg_silver">
        <h1>{{ $user->name }}'s Space <small>Features are still under construction</small></h1>
    </div>



    <div class="col-md-2 col-md-offset-2">
        <div class="well bg_silver">
            <img src="https://www.gravatar.com/avatar/{{ md5(Auth::user()->email) }}?d=mm&s=140" alt="...">
        </div>
    </div>
    <div class="col-md-6">
        <div class="well bg_silver">
            @if(Auth::user()->id == $user->id)
            <form action="{{ Route('status.post') }}" method="POST">
                {{ csrf_field() }}
                <textarea class="form-control textarea" name="status" placeholder="Say something..."></textarea>
                <input type="submit" class="btn btn-default btn-primary margin_top">
            </form>

            <hr>
            @endif
            <h4>What friends said:</h4>
            @if (!$statuses->count())
                <p>There's no status</p>
                @else
                    @foreach($statuses as $status)
                        <hr>
                    <div class="media">
                        <a class="pull-left" href="#">
                            <img class="media-object" alt="..." src="https://www.gravatar.com/avatar/{{ md5($user->email) }}?d=mm&s=80">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading"><a href="{{ url('/'.$status->user->id) }}">{{ $status->user->getName() }}</a></h4>
                            <p>{{ $status->status }}</p>
                            <ul class="list-inline">
                                <li>{{ $status->created_at->diffForHumans() }}</li>
                                {{--<li><a href="#">Like</a></li>--}}
                                {{--<li>10 likes</li>--}}
                            </ul>

                            {{--<div class="media">--}}
                                {{--<a class="pull-left" href="#">--}}
                                    {{--<img class="media-object" alt="" src="">--}}
                                {{--</a>--}}
                                {{--<div class="media-body">--}}
                                    {{--<h5 class="media-heading"><a href="#">Billy</a></h5>--}}
                                    {{--<p>Yes, it is lovely!</p>--}}
                                    {{--<ul class="list-inline">--}}
                                        {{--<li>8 minutes ago.</li>--}}
                                        {{--<li><a href="#">Like</a></li>--}}
                                        {{--<li>4 likes</li>--}}
                                    {{--</ul>--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            {{--<form role="form" action="#" method="post">--}}
                                {{--<div class="form-group">--}}
                                    {{--<textarea name="reply-1" class="form-control" rows="2" placeholder="Reply to this status"></textarea>--}}
                                {{--</div>--}}
                                {{--<input type="submit" value="Reply" class="btn btn-default btn-sm">--}}
                            {{--</form>--}}
                        </div>
                    </div>
                    @endforeach
                <div class="center">
                {{ $statuses->links() }}
                </div>
            @endif
        </div>
    </div>
</div>


@endsection
