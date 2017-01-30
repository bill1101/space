<?php
/**
 * Created by PhpStorm.
 * User: tyx
 * Date: 1/29/17
 * Time: 8:22 PM
 */

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Album;
use App\Photo;
use Auth;
use Illuminate\Http\Request;
use Session;

class PhotoController extends Controller
{
    public function index($album_id){
        $album = Album::find($album_id);
        $user = $album->user()->first();
        $photos = $album->photos()->get();
        //dd($photos);
        return view('photo.index')->with('user',$user)->with('photos',$photos)->with('album_id',$album_id);
    }

    public function store(Request $request){
        $this->validate($request,[
            'title' => 'required|max:255',
            'description' => 'max:255',
            'location' => 'max:255',
            'photo' => 'file|required',
        ]);


        $description = $request->description;
        $image = $request->file('photo');

        if($image){
            $image_filename = time().".jpg";
            $image->move(public_path('photos'),$image_filename);
        }else{
            $image_filename = 'default.jpg';
        }

        DB::table('photos')->insert([
            'title' => $request->title,
            'name' => $image_filename,
            'description' => $description,
            'album_id' => $request->album_id,
        ]);
        Session::flash('success','Photo successfully created.');

        $id = Auth::user()->id;
        return redirect()->to('/photos/'.$request->album_id)->with('user',Auth::user());
        //return redirect()->route('photo.index',['album_id'=>$request->id])->with('user',Auth::user());
    }

    public function single($photo_id){
        $photo = Photo::find($photo_id);
        $user = $photo->album()->first()->user()->first();
        return view('photo.single')->with('photo',$photo)->with('user',$user);
    }
}