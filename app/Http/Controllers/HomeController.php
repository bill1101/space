<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Status;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if(Auth::check()){
            $statuses = Status::where(function($query){
                return $query->where('user_id',Auth::user()->id)
                    ->orWhereIn('user_id',Auth::user()->friends()->pluck('id'));
            })->orderBy('created_at','desc')->paginate(5);
            //dd($statuses);
            return view('home')->with('user',$user)->with('statuses',$statuses);
        }
        return view('home');
    }
    public function indexUser($id)
    {
    //$username = Auth::user()->name;
        $user = User::find($id);
        if(Auth::check() && Auth::user()->id==$id){
            $statuses = Status::where(function($query){
                return $query->where('user_id',Auth::user()->id)
                    ->orWhereIn('user_id',Auth::user()->friends()->pluck('id'));
            })->orderBy('created_at','desc')->paginate(5);
            //dd($statuses);
            return view('home')->with('user',$user)->with('statuses',$statuses);
        }else if(Auth::check()){
            $statuses = Status::where('user_id',$id)->orderBy('created_at','desc')->paginate(5);
            //dd($statuses);
            return view('home')->with('user',$user)->with('statuses',$statuses);
        }
        return view('home')->with('user',$user);
    }

    public function mainblade(){
        return view('layouts.main');
    }
}
