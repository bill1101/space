<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class SearchController extends Controller
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

    public function getResults(Request $request){
        $search = $request->input('search');
        if(!$search){
            return redirect()->route('home');
        }

        $users = DB::table('users')
                ->where('firstname','like',"%{$search}")
                ->orWhere('lastname','like',"%{$search}")
                ->orWhere('name','like',"%{$search}")
                ->get();



        return view('search.results')->with('search',$search)->with('users',$users)->with('user',Auth::user());
    }

}