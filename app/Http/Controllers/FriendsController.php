<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use Auth;
use Session;

class FriendsController extends Controller
{
    public function getFriends($username){
        $user = User::where('name',$username)->first();
        if(!$user){
            abort(404);
        }
        $waiting = Auth::user()->friendRequestsPending();
        return view('friends.index')->with('user',$user)->with('waiting',$waiting);
    }

    public function getRequests(){
        $waiting = Auth::user()->friendRequestsPending();
        return view('friends.requests')->with('waiting',$waiting)->with('user',Auth::user());
    }

    public function getAdd($name){
        $user = User::where('name',$name)->first();
        if(!$user){
            Session::flash('danger','Person cannot be found');
            return redirect()->route('home');
        }
//        if(Auth::user()->isFriendWith($user)){
//            Session::flash('danger','Requests failed1');
//            return redirect()->route('home');
//        }else if(Auth::user()->hasFriendRequestPending($user)){
//            Session::flash('danger','Requests failed2');
//            return redirect()->route('home');
//        }else if($user->hasFriendRequestPending(Auth::user())){
//            Session::flash('danger','Requests failed3');
//            return redirect()->route('home');
//        }

        Auth::user()->addFriend($user);
        Session::flash('success','Request has been sent');
        return redirect()->to('friends/'.Auth::user()->name);

    }

    public function getAccept($name){
        $user = User::where('name',$name)->first();
        if(!$user){
            Session::flash('danger','Person cannot be found');
            return redirect()->route('home');
        }
        //dd(!Auth::user()->hasFriendRequestReceived($user));
        if(!Auth::user()->hasFriendRequestReceived($user)){
            Session::flash('danger','Failed');
            return redirect()->route('home');
        }
        Auth::user()->acceptFriendRequest($user);
        Session::flash('success','Request has been accepted');
        return redirect()->to('friends/'.Auth::user()->name);
    }
}