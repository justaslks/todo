<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function currentUser()
    {
        $user = Auth::user();

        return response($user);
    }
}
