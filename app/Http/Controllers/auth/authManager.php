<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        $request->validate([
            'email'=>'required',
            'password'=>'required'
        ]);

        $credentials= $request->only('email','password');
        if(Auth::attempt($credentials)){
            return redirect()->intended(route('home'));
        }
        return redirect('login')->with('error',"Invalid User !");
    }

    public function registerPost(Request $request){

        if (Auth::check()){
            return redirect('/tasks');
        }
        $request->validate([
            'name'=>['required'],
            'email'=>['required','email'],
            'password'=>['required']
        ]);

        $credentials= $request->only('name','email','password');
        $user=User::create($credentials);
        if($user){
            return redirect()->intended(route('home'));
        }
        return redirect('register')->with('error',"Error Try Again !");
    }

    public function logOut(){
        session()->flush();
        Auth::logout();
        return redirect('/login');
    }
}
