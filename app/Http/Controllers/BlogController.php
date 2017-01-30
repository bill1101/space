<?php
/**
 * Created by PhpStorm.
 * User: tyx
 * Date: 1/29/17
 * Time: 9:39 AM
 */

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Session;
use App\Blog;

class BlogController extends Controller
{
    public function showBlog($id){
        $user = User::find($id);
        $blogs = Blog::where('user_id', $id)
            ->orderBy('created_at','desc')->paginate(5);
        //dd($blogs);
        return view('blog.index')->with('user',$user)->with('blogs',$blogs);
    }

    public function create(){
        return view('blog.create');
    }

    public function store(Request $request){
        $this->validate($request,[
            'title' => 'required|max:255',
            'blog' => 'required'
        ]);

        $blog = new Blog;
        $blog->user_id = Auth::user()->id;
        $blog->title = $request->title;
        $blog->blog = $request->blog;
        $blog->save();
        $id = Auth::user()->id;
        return redirect()->route('blog.index',['id'=>$id])->with('user',Auth::user());
    }
}