<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function change_status(Request $request){
        $id = $request->id;

        $task = Task::where('id',$id)->first();

        if($task->completed==1)
            $completed = 0; // change to pending
        else
            $completed = 1; // change to completed

        $task->completed=$completed;
        $task->save();

        return redirect('/dashboard')->with('success');
    }
}
