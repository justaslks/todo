<?php

namespace App\Http\Controllers;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

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
                return Task::with(['users' => function ($query) {
                        $query->where('user_id', Auth::user()->id);
                    }])->orderBy(request('sorter'))->get();

            return Task::with(['users' => function ($query) {
                    $query->where('user_id', Auth::user()->id);
                }])->orderByDesc(request('sorter'))->get();
        }

        return  Task::with(['users' => function ($query) {
            $query->where('user_id', Auth::user()->id);
        }])->get();
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
