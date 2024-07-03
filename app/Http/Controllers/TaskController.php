<?php

namespace App\Http\Controllers;

use App\Models\task;
use Illuminate\Http\Request;
use function Symfony\Component\Translation\t;

class TaskController extends Controller
{
    public function saveTask(Request $request)
    {
        $task = $request->validate([
            'task' => ['required']
        ]);
        task::create($task);
        $data= task::all();
        return view('tasks')->with('tasks',$data);

    }

    public function updateStatus($id){

        $task = task::find($id);
        $task->isComplete = !$task->isComplete;
        $task->save();
        $data = task::all();
        return view('tasks')->with('tasks',$data);

    }

    public function deleteTask($id){

        task::find($id)->delete();
        $data = task::all();
        return view('tasks')->with('tasks',$data);

    }

    public function updateTask($id){
        $task=task::find($id);
        return view('update')->with('task',$task);
    }

    public function changeTask(Request $request){
        $request->validate([
            'task' => ['required'],
        ]);
        $data=task::find($request->id);
        $data->task=$request->task;
        $data->save();
        $data = task::all();
        return view('tasks')->with('tasks',$data);
    }

    public function tasks(){
        $data = task::all();
        return view('tasks')->with('tasks',$data);
    }
}
