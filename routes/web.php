<?php

use App\Http\Controllers\auth\authManager;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::group(['middleware'=>'auth'],function (){
    Route::get('/', function () {
        if(!Auth::check()){
            return redirect('tasks');
        }
        return view('login');
    });

    Route::get('/tasks',[TaskController::class, 'tasks'])->name('home');
    Route::post('/save',[TaskController::class, 'saveTask']);
    Route::get('/mark/{id}',[TaskController::class,'updateStatus']);
    Route::get('/delete/{id}',[TaskController::class,'deleteTask']);
    Route::get('/update/{id}',[TaskController::class,'updateTask']);
    Route::get('/update',[TaskController::class,'changeTask']);
    Route::get('/profile',[authManager::class,'profile']);
});


Route::get('/login',[authManager::class, 'logIn'])->name('login');
Route::post('/login',[authManager::class, 'logInPost'])->name('login.post');
Route::get('/register',[authManager::class, 'register'])->name('register');
Route::post('/register',[authManager::class, 'registerPost'])->name('register.post');
Route::get('/logout',[authManager::class, 'logOut'])->name('logOut');
