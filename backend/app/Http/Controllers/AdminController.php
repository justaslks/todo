<?php

namespace App\Http\Controllers;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * To create admin user
     * php artisan tinker
     * User::create(['name'=>'admin', 'email'=>'admin@admin.com', 'isAdmin'=>'1', 'password'=>bcrypt('adminas')])
     */
    //admin functions
    public function getAssignments()
    {
        return Task::with('users')->get();
    }
}
