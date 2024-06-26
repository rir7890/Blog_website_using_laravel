<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function register(Request $request){
        // dd($request->all());
        $validated = $request->validate([
            "name" => "required|string|max:50",
            "email"=> "required|email|unique:users,email|max:50",
            "password" => "required|string|confirmed",
            "phone" => "required|string|max:10",
            "image" => "nullable|image|mimes:jpeg,png,jpg,gif|max:2048",
        ]);
        
        // dd($validated);
        
        $new_user = User::create($validated);
        if ($request->hasFile('image')) {
        //     $image = $request->file('image');
        //     $imageName = time().'.'.$image->getClientOriginalExtension();
        //     $image->storeAs('images/', $imageName);
        //     $new_user->profile_image = $imageName;
        //     $new_user->save();
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);  
            $new_user->image = 'images/'.$imageName;
            
        }
        $new_user->save();
        return redirect()->route('loginPage')->with('success','User created Successfully.');
    }

    public function login(){ 
        return view('login');
    }

    public function loginUser(Request $request){
        
         $credentials=$request->validate([
            "email"=> "required|email|max:50",
            "password" => "required|string",
        ]);
        // dd(Auth::attempt($credentials));
        
        if(Auth::attempt($credentials)){
            return redirect()->route('dashboard')->with('success', 'User Logined in successfully.');
        }

        return redirect()->back()->with('error', 'User Logined Failed');
    }

    public function dashboard(){
        return view('dashboard',['user'=> Auth::user()]);
    }

    public function logout(){
        Auth::logout();
        // Session::flush();
        return redirect('/login')->with('success', 'User Logout Successfully');
    }

    public function userEdit(){
        if(!Auth::check()){
            return redirect()->route('login.user')->with('success', 'User Login is needed.');
        }
        return view('useredit',['user' => Auth::user()]);
    }

    public function profileUpdate(Request $request){
        $user=Auth::user();

        $validator=$request->validate([
            "name" => "string|max:50",
            "email"=> "email|max:50",
            "phone" => "string|max:10",
        ]);

        DB::table('users')->where('id',$user->id)->update([
            'name' => $validator['name'],
            'email' => $validator['email'],
            'phone' => $validator['phone']
        ]);

        return redirect()->back()->with('success','User information updated successfully.');
        
    }
}