<?php

namespace App\Http\Controllers;

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
}
