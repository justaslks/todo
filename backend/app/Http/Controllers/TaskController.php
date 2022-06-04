<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    //get all tasks
    public function getTasks()
    {
        return Task::all();
    }

    //task creation
    public function createTask(Request $request)
    {
        $field = $request->validate([
            'task' => 'required',
        ]);

        $task = Task::create([
            'task' => $field['task'],
            'description' => $request->input('description')
        ]);

        return response($task, 201);
    }

    //delete task by id
    public function deleteTask($id)
    {
        $existingTask = Task::find($id);

        if($existingTask){
            $existingTask->delete();
            return "Task successfully deleted";
        }   

        return "Task not found";
    }

    public function updateTask(Request $request, $id){
        $field = request()->validate([
            'task' => 'required',
        ]);
        
        $success = Task::where('id', $id)
            ->update([
                'task' => $field['task'],
                'description' => request('description')
            ]);

        if($success){
            return "Task updated successfully";
        }
        return "Something went wrong";
    }
}
