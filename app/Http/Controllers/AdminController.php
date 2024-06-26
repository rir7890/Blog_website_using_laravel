<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function adminPage(){
        $users=DB::table('users')->whereNot('id',Auth::user()->id)->get();
        // $users=DB::table('users')->get();
        return view('adminpage',compact('users'));
    }

    public function getAllBlogs($id){
        $blogs=DB::table('blogs')->where('user_id',$id)->get();
        $user=DB::table('users')->where('id',$id)->first();
        return view('adminblogview',['blogs'=>$blogs,'user'=>$user]);
    }       

    public function deleteUserBlogs($id){
        DB::table('blogs')->where('id',$id)->delete();
        return redirect()->route('admin.userblogs')->with('success','user blog deleted successfully.');
    }

    public function adminDeleteUser($id){
        DB::table('users')->where('id',$id)->delete();
        return redirect()->bac()->with('success','user deleted successfully.');
    }
}