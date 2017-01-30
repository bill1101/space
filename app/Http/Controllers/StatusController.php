<?php
/**
 * Created by PhpStorm.
 * User: tyx
 * Date: 1/28/17
 * Time: 6:13 PM
 */

namespace App\Http\Controllers;
use Auth;
use App\User;
use Illuminate\Http\Request;
use Session;

class StatusController extends Controller
{
    public function postStatus(Request $request){
        $this->validate($request,[
            'status'=>'required|max:500',
        ]);

        Auth::user()->statuses()->create([
            'status' => $request->status,
        ]);
        Session::flash('success','status posted');
        return redirect()->route('home')->with('user',Auth::user());
    }
}