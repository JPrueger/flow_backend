<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/todos', [App\Http\Controllers\TodosController::class, 'index']);
Route::post('/todos', [App\Http\Controllers\TodosController::class, 'store']);

// register user
Route::post('/user/register', [App\Http\Controllers\AuthController::class, 'register']);

// login user
Route::post('/user/login', [App\Http\Controllers\AuthController::class, 'login']);

// store Project
Route::post('/add-project/create', [App\Http\Controllers\ProjectController::class, 'store']);

//delete Project
Route::delete('/delete-project/{id}', [App\Http\Controllers\ProjectController::class, 'destroy']);

// sorting tasks
Route::post('/sort-task', [App\Http\Controllers\ProjectController::class, 'sort']);

// get all tasks
Route::get('/tasks/index/{id}', [App\Http\Controllers\TaskController::class, 'index']);

//get task details
Route::get('/task/{id}', [App\Http\Controllers\TaskController::class, 'show']);

//list all my projects
Route::get('/projects/{id}', [App\Http\Controllers\ProjectController::class, 'showMyProjects']);

//update task
Route::get('/tasks/{id}', [App\Http\Controllers\TaskController::class, 'update']);

// create task
Route::post('/add-task/{id}', [App\Http\Controllers\TaskController::class, 'store']);

//delete task
Route::delete('/delete-task/{id}', [App\Http\Controllers\TaskController::class, 'destroy']);

// update task
Route::post('/edit-task/{id}', [App\Http\Controllers\TaskController::class, 'update']);

// update profile when video has been played already
Route::post('/user/update/{id}', [App\Http\Controllers\UserController::class, 'update']);

// get logged in  user
Route::middleware(['auth:sanctum'])->get('/user/me', [App\Http\Controllers\AuthController::class, 'me']);

Route::get('/user/all-users', [App\Http\Controllers\UserController::class, 'getAllUsers']);

Route::get('/user/{id}', [App\Http\Controllers\AuthController::class, 'getUserData']);

Route::get('/project-users/{id}', [App\Http\Controllers\ProjectController::class, 'getAllProjectUsers']);

Route::get('/project-tasks/{id}', [App\Http\Controllers\ProjectController::class, 'getAllProjectTasks']);

Route::get('/updateStoryPoints/{taskId}', [App\Http\Controllers\TaskController::class, 'updateStoryPoints']);

Route::get('/project-details/{id}', [App\Http\Controllers\ProjectController::class, 'getProject']);
