<?php

namespace App\Http\Controllers;

use App\Models\task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function Symfony\Component\Translation\t;

class TaskController extends Controller
{
    public function saveTask(Request $request)
    {
        if (!Auth::check()){
            return redirect('/login');
        }
        $task = $request->validate(['task' => ['required'],'user_id'=>['required']]);
        task::create($task);
        return redirect('tasks');
    }

    public function updateStatus($id)
    {
        if (!Auth::check()){
            return redirect()->intended('/login');
        }
        $task = task::find($id);
        $task->status = !$task->status;
        $task->save();
        return redirect()->intended('tasks');
    }

    public function deleteTask($id)
    {
        if (!Auth::check()){
            return redirect('/login');
        }
        task::find($id)->delete();
        return redirect('tasks');
    }

    public function updateTask($id)
    {
        if (!Auth::check()){
            return redirect('/login');
        }
        $task = task::find($id);
        return view('update')->with('task', $task);
    }

    public function changeTask(Request $request)
    {
        if (!Auth::check()){
            return redirect('/login');
        }
        $request->validate(['task' => ['required'],]);
        $data = task::find($request->id);
        if($data->user_id = Auth::user()->id){
            $data->task = $request->task;
            $data->save();
            return redirect('tasks');
        };
        return redirect('tasks')->with('errors',['User Not Valid']);
    }

    public function tasks()
    {
        if (!Auth::check()){
            return redirect('/login');
        }
        $user = Auth::user();
        $data = task::all()->where('user_id',$user->id);
        return view('tasks')->with(['tasks'=>$data,'user'=>$user]);
    }
}
