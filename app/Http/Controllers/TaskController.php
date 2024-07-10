<?php

namespace App\Http\Controllers;

use App\Models\task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class TaskController extends Controller
{
    public function save_task(Request $request)
    {
        $request->validate(['task'=>['required']]);
        if (!Auth::check()) {
            return redirect('/login');
        }
        $task = new task();
        $task->task = $request->input('task');
        $task->user_id = Auth::user()->id;
        task::create([
            "task"=>$task->task,
            "user_id"=>$task->user_id
        ]);
    }

    public function update_status(Request $request)
    {
        $id = $request->input('value');
        if (!Auth::check()) {
            return redirect()->intended('/login');
        }
        $task = task::find($id);
        if (Auth::user()->id === $task->user_id) {
            $task->status = !$task->status;
            $task->save();
            return "success";
        } else {
            return 'Error';
        }

    }

    public function update_task_view($id){
        $task = task::find($id);
        return View::make('update',['task'=>$task]);
    }

    public function delete_task(Request $request)
    {
        $id = $request->input('value');
        if (!Auth::check()) {
            return redirect('/login');
        }
        $task = task::find($id);
        if (Auth::user()->id === $task->user_id) {
            task::find($id)->delete();
            return 'success';
        } else {
            return 'error';
        }

    }

    public function updateTask(Request $request)
    {   $id = $request->input('value');
        if (!Auth::check()) {
            return redirect('/login');
        }
        $task = task::find($id);
        if (Auth::user()->id === $task->user_id) {
            return $id;
        } else {
            return "User Not Match";
        }

    }

    public function update_task_post(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }
        $request->validate(['task' => ['required'],]);
        $task = task::find($request->id);
        if ($task->user_id = Auth::user()->id) {
            $task->task = $request->task;
            $task->save();
            return 'success';
        };
        return 'User Not Valid';
    }

    public function tasks()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        return view('tasks');
    }

    public function load_tasks()
    {
        $user = Auth::user();
        return task::all()->where('user_id', $user->id);

    }
}
