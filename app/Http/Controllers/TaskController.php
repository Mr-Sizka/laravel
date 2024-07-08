<?php

namespace App\Http\Controllers;

use App\Models\task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function saveTask(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }
        $task = $request->validate(['task' => ['required'], 'user_id' => ['required']]);
        task::create($task);
        return redirect('tasks');
    }

    public function updateStatus($id)
    {
        if (!Auth::check()) {
            return redirect()->intended('/login');
        }
        $task = task::find($id);
        if (Auth::user()->id === $task->user_id) {
            $task->status = !$task->status;
            $task->save();
            return redirect()->intended('tasks');
        } else {
            return view('login')->with('apiErrors',["error"]);
        }

    }

    public function deleteTask($id)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }
        $task = task::find($id);
        if (Auth::user()->id === $task->user_id) {
            task::find($id)->delete();
            return redirect('tasks');
        } else {
            return redirect('/tasks')->with('apiErrors', ['User Not Match']);
        }

    }

    public function updateTask($id)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }
        $task = task::find($id);
        if (Auth::user()->id === $task->user_id) {
            $task = task::find($id);
            return view('update')->with('task', $task);
        } else {
            return redirect('/login')->with('errors', ['User Not Match']);
        }

    }

    public function changeTask(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }
        $request->validate(['task' => ['required'],]);
        $data = task::find($request->id);
        if ($data->user_id = Auth::user()->id) {
            $data->task = $request->task;
            $data->save();
            return redirect('tasks');
        };
        return redirect('tasks')->with('errors', ['User Not Valid']);
    }

    public function tasks()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }
        $user = Auth::user();
        $data = task::all()->where('user_id', $user->id);
        return view('tasks')->with(['tasks' => $data, 'user' => $user]);
    }
}
