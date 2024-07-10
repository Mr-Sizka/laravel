<?php

use App\Http\Controllers\auth\authManager;
use App\Http\Controllers\ReportController;
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
    Route::get('/load_tasks',[TaskController::class, 'load_tasks'])->name('load_tasks');
    Route::post('/save_task',[TaskController::class, 'save_task']);
    Route::get('/update_status',[TaskController::class,'update_status']);
    Route::get('/delete_task',[TaskController::class,'delete_task']);
    Route::get('/update_task',[TaskController::class,'updateTask']);
    Route::get('/update_task_view/{id}',[TaskController::class,'update_task_view']);
    Route::post('/update_task_post',[TaskController::class,'update_task_post']);
    Route::get('/profile',[authManager::class,'profile']);
    Route::get('/profile_view/{id}',[authManager::class,'profile_view']);
    Route::get('/report',[ReportController::class,'generateReport']);
});


Route::get('/login',[authManager::class, 'logIn'])->name('login');
Route::post('/login',[authManager::class, 'logInPost'])->name('login.post');
Route::get('/register',[authManager::class, 'register'])->name('register');
Route::post('/register',[authManager::class, 'registerPost'])->name('register.post');
Route::get('/logout',[authManager::class, 'logOut'])->name('logOut');
