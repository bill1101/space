<?php
/**
 * Created by PhpStorm.
 * User: tyx
 * Date: 1/29/17
 * Time: 3:40 PM
 */

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Session;

class AlbumController extends Controller
{
    public function index($id){

        $albums = DB::table('albums')->where('user_id',$id)->get();


        $user = User::find($id);
        return view('album.index',['id',$id])->with('user',$user)->with('albums',$albums);
    }

    public function create(){
        return view('album.create');
    }

    public function store(Request $request){
        $this->validate($request,[
            'name' => 'required|max:255',
            'cover' => 'file',
        ]);

        $name = $request->name;
        $description = $request->description;
        $cover_image = $request->file('cover');

        if($cover_image){
            $cover_image_filename = time().".jpg";
            $cover_image->move(public_path('photos'),$cover_image_filename);
        }else{
            $cover_image_filename = 'default.jpg';
        }

        DB::table('albums')->insert([
            'name' => $name,
            'description' => $description,
            'cover' => $cover_image_filename,
            'user_id' => Auth::user()->id,
        ]);
        Session::flash('success','Album successfully created.');

        $id = Auth::user()->id;
        return redirect()->route('album.index',['id'=>$id])->with('user',Auth::user());
    }
}