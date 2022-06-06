<?php

namespace App\Http\Controllers;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
        if(request('sorter')){
            $sorter = request('sorter');
            
            if($sorter == 'created_at')
                return Task::orderByDesc(request('sorter'))->with('users')->get();

            return Task::orderBy(request('sorter'))->with('users')->get();
        }
        return Task::with('users')->get();
    }

    public function createUser(Request $request){
        $field = $request->validate([
            'name'     => 'required',
            'email'    => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed'
        ]);

        $user = User::create([
            'name'     => $field['name'],
            'email'    => $field['email'],
            'password' => bcrypt($field['password'])
        ]);

        $token = $user->createToken('usertoken')->plainTextToken;

        $response = [
            'user'  => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function deleteUser($id)
    {
        $existingUser = User::find($id);
        
        if($existingUser){
            DB::table('assignments')->where('user_id', $id)->delete();
            $existingUser->delete();
            return 'User successfully deleted';
        }
        return 'Something went wrong';
    }

    public function editUser($id){
        if(request('email') != ''){
            $field = request()->validate([
                'email'    => 'email|unique:users'
            ]);
        }
     
        $user = User::find($id);
        
        $success = $user->update([
            'name' => request('name') != '' ? request('name') : $user->name,
            'email' => request('email') != '' ? request('email') : $user->email,
            'isAdmin' => request('isAdmin') != '' ? request('isAdmin') : $user->isAdmin
        ]);

        return [
            'success' => $success
        ];

    }
}
