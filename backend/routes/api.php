<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//public routes
Route::post('/register', [AuthController::class, 'registerUser']);
Route::post('login', [AuthController::class, 'loginUser']);

//authenticated routes
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::post('/logout', [AuthController::class, 'logoutUser']);
    Route::get('/user', [UserController::class, 'currentUser']);
    Route::get('/usertasks', [UserController::class, 'getMyTasks']);
    Route::put('/status/{task}', [UserController:: class, 'changeStatus']);
    Route::group(['middleware' => ['is_admin']], function(){
        Route::post('/task', [TaskController::class, 'createTask']);
        Route::get('/assignments', [AdminController::class, 'getAssignments']);
        Route::get('/users', [UserController:: class, 'getUsers']);
        Route::delete('/task/{task}', [TaskController::class, 'deleteTask']);
        Route::post('/adduser', [AdminController::class, 'createUser']);
        Route::delete('/user/{user}', [AdminController::class, 'deleteUser']);
        Route::put('/user/{user}', [AdminController::class, 'editUser']);
    });
});
