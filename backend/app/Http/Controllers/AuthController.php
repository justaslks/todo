<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{    
    public function registerUser(Request $request)
    {
        //takes values an validates them
        $field = $request->validate([
            'name'     => 'required',
            'email'    => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed'
        ]);

        //creates a user
        $user = User::create([
            'name'     => $field['name'],
            'email'    => $field['email'],
            'password' => bcrypt($field['password'])
        ]);

        //creates a token
        $token = $user->createToken('usertoken')->plainTextToken;

        $response = [
            'user'  => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function loginUser(Request $request)
    {
        //validates values
        $field = $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);
        
        //find user by email
        $user = User::where('email', $field['email'])->first();

        //check if that user exist, and if passwords matches
        if(!$user || !Hash::check($field['password'], $user->password)){
            return response('Login was unsuccessful: bad credentials', 401);
        }

        //creates a token
        $token = $user->createToken('usertoken')->plainTextToken;

        $response = [
            'user'  => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function logoutUser(Request $request)
    {
        auth()->user()->tokens()->delete();

        return 'Logget out successfully';
    }
}
