<?php

namespace App\Http\Controllers;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function currentUser()
    {
        $user = Auth::user();

        return response($user);
    }

    public function getUsers()
    {
        $user = Auth::user()->id;

        return User::all()->except(Auth::id($user));
    }

    public function getMyTasks()
    {
        $useris = Auth::user()->id;

        if(request('sorter')){
            $sorter = request('sorter');
            if($sorter == 'status')
                return Task::with('users')->orderBy(request('sorter'))->get();

            return Task::with('users')->orderByDesc(request('sorter'))->get();
        }
        $tasks = Task::with('users')->get();

        return $tasks;
    }

    public function changeStatus($id)
    {
        $task = Task::find($id);
    
        $success = $task->update([
            'status' => request('status')
        ]);

        return [
            'success' => $task
        ];
    }
}
