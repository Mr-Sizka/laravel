<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function generateReport(){
        $tasks=DB::table('tasks')->leftJoin('users','tasks.user_id','=','users.id')->get();
        return view('report')->with('tasks',$tasks);
    }
}
