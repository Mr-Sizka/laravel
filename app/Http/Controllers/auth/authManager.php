<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class authManager extends Controller
{
    public function logIn(){
        if (Auth::check()){
            return redirect('/tasks');
        }
        return view('/login');
    }

    public function register(){
        if (Auth::check()){
            return redirect('/tasks');
        }
        return view('/register');
    }

    public function logInPost(Request $request){

        if (Auth::check()){
            return redirect('/tasks');
        }
        $request->validate([
            'email'=>'required',
            'password'=>'required'
        ]);

        $credentials= $request->only('email','password');
        if(Auth::attempt($credentials)){
            Session::put('user_id',Auth::user()->id);
            return redirect()->intended(route('home'));
        }
        return redirect('login')->with('errors',["Invalid credentials !"]);
    }

    public function registerPost(Request $request){

        if (Auth::check()){
            return redirect('/tasks');
        }

        $request->validate([
            'first_name'=>['required'],
            'last_name'=>['required'],
            'email'=>['required','email'],
            'password'=>['required'],
            'image' => ['required','image','mimes:jpeg,png,jpg','max:2048']
        ]);

        $credentials= $request->only('first_name','last_name','email','password');
        $user=User::all()->where('email',$request->email);
        if (!$user->isEmpty()){
            return redirect('register')->with('errors',['User Already Exists']);
        }

        $image= $request->image;
        $ext = $image->getClientOriginalExtension();
        $imageName = time().'.'.$ext;

        $image->move(public_path('uploads/images'),$imageName);
        $user=User::create([
            'first_name'=>$credentials['first_name'],
            'last_name'=>$credentials['last_name'],
            'email'=>$credentials['email'],
            'password'=>$credentials['password'],
            'image'=>$imageName]);
        if($user->exists){
            $credentials= $request->only('email','password');
            if(Auth::attempt($credentials)){
                return redirect()->intended(route('home'));
            }
            return redirect('login');
        }
        return redirect('register')->with('errors',["Error Try Again !"]);
    }

    public function logOut(Request $request){
        Auth::logout();
        $request->session()->flush();
        $request->session()->regenerateToken();
        return redirect()->intended('/login');
    }

    public function profile(){
        if (!Auth::check()) {
            return "Please LogIn";
        }
        return Auth::user()->id;
    }

    public function profile_view(){

        if (!Auth::check()) {
            return redirect('/login');
        }
        return View::make('profile',['user'=>Auth::user()]);
    }
}
