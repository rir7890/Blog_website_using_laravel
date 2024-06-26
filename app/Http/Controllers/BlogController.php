<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function showAllBlogs(){
        $blogs = DB::table('blogs')
            ->join('users', 'blogs.user_id', '=', 'users.id')
            ->select('blogs.*', 'users.name as user_name', 'users.email as user_email','users.phone as user_phone')
            ->get();
        return view('allblogs',compact('blogs'));
    }

    public function blogPage(){
        return view('createBlog');
    }
    public function createBlog(request $request){
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        DB::table('blogs')->insert([
            'title'=> $request->title,
            'description'=> $request->content,
            'user_id'=> Auth::user()->id,
            'created_at'=> now(),
            'updated_at'=> now(),
        ]);

        return redirect()->back()->with('success','Blog Created Successfully.');
    }

    public function myBlogs(){
        $blogs = DB::table('blogs')->where('user_id', Auth::user()->id)->get();
        return view('myblog',compact('blogs'));
    }

    public function myBlog($id){
        $blog = DB::table('blogs')->where('id',$id)->first();
        // dd($blog);
        return view('blogshow',['blog'=> $blog]);
    }

    public function myBlogEdit(Request $request, $id){
        
        $request->validate([
            'title'=> 'string|max:50',
            'content' => 'string|max:250',
        ]);
        DB::table("blogs")->where("id", $id)->update([
            "title"=> $request->title,
            "description"=> $request->content
        ]);
        return redirect()->back()->with("success","Blog updated successfully.");
    }

    public function myBlogDelete($id){
        DB::table('blogs')->where('id',$id)->delete();
        return redirect()->route('my.blogs');
    }
}