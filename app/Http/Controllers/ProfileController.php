<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use Auth;
use Session;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getProfile($username){
        $user = User::where('name',$username)->first();
        if(!$user){
            abort(404);
        }
        return view('profile.index')->with('user',$user);
    }

    public function getEdit(){
        $user = User::where('name',Auth::user()->name)->first();
        if(!$user){
            abort(404);
        }
        return view('profile.edit');
    }

    public function postEdit(Request $request)
    {
        $this->validate($request,[
            'firstname' => 'alpha|max:30',
            'lastname' => 'max:30',
            'location' => 'max:30',

        ]);

        Auth::user()->update([
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'location' => $request->input('location'),
            'phone' => $request->input('phone'),
        ]);

        Session::flash('success','Your profile has been updated');
        return redirect()->route('profile.index',['username'=>Auth::user()->name]);
    }
}