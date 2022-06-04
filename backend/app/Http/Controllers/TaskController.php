<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Assignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            'user' => 'required'
        ]);

        $task = Task::create([
             'task'        => $field['task'],
             'description' => $request->input('description')
        ]);
        
        //check if that task is already assigned to user
        $existingTask = Assignment::where([
                ['task_id', $task->id],
                ['user_id', $field['user']]
            ])->exists();

        if($existingTask){
            return 'Task is already exist with this user';
        }   

        $assignTask = DB::table('assignments')->insert([
            'user_id' => $field['user'],
            'task_id'      => $task->id
        ]);

        if($assignTask){
            return response([
                'Task successfuly created', 
                $task, 201
            ]);
        }

        return 'Something went wrong';
    }

    //delete task by id
    public function deleteTask($id)
    {
        $existingTask = Task::find($id);

        if($existingTask){
            DB::table('assignments')->where('task_id', $id)->delete();
            $existingTask->delete();
            return "Task successfully deleted";
        }   

        return "Task not found";
    }

    public function updateTask(Request $request, $id){
        $field = request()->validate([
            'task' => 'required',
        ]);
        
        $success = Task::where('id', $id)->update([
                'task'        => $field['task'],
                'description' => request('description')
        ]);

        if($success){
            return 'Task updated successfully';
        }
        return 'Something went wrong';
    }
}
