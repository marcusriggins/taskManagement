<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use DB;

class TaskController extends Controller
{
    public function __construct()
    {

    }
    public function view()
    {
        $tasks = Task::all();
        for ($i = 0; $i < count($tasks) - 1; $i ++)
        {
            for ($j = $i + 1; $j < count($tasks); $j ++)
            {
                if ($tasks[$i]->priority > $tasks[$j]->priority)
                {
                    $temp = $tasks[$i];
                    $tasks[$i] = $tasks[$j]; 
                    $tasks[$j] = $temp;  
                }
            }
        }
        return view("task.list")->with("tasks", $tasks);        
    }    
    public function addTask(Request $request){
        $tasks = Task::all();
        if ($request['priority'] == "first")
        {
            foreach ($tasks as $task){
                $task->priority += 1;
                $task->save();
            }
        }

        $task = new Task();
        $task->name = $request['name'];
        $task->project = $request['project'];
        $task->priority = $request['priority'] == "first" ? 1 : count($tasks) + 1;
        $task->save();

        return redirect()->back();
    } 
    public function editTask(Request $request){
        $task = Task::where("id", $request['id'])->first();
        $task->name = $request['name'];
        $task->project = $request['project'];
        $task->save();

        return redirect()->back();
    } 
    public function removeTask(Request $request){
        $task = Task::where("id", $request['id'])->first();
        $priority = $task->priority;
        Task::where("id", $request['id'])->delete();
        $tasks = Task::where("priority", ">", $priority)->get();
        foreach($tasks as $task){
            $task->priority -= 1;
            $task->save();
        }
        
        return redirect()->back(); 
    }
    public function orderTask(Request $request){
        $tasks = Task::all();
        $index = 0;
        foreach ($tasks as $task){
            $task->priority = array_search($task->id, $request['order']) + 1;
            $task->save();
        }
        return json_encode($request['order']);
    }
}
