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

// sorting tasks
Route::post('/sort-task', [App\Http\Controllers\ProjectController::class, 'sort']);

// get all tasks
Route::get('/tasks/index/', [App\Http\Controllers\TaskController::class, 'index']);

// create task
Route::post('/add-task/create', [App\Http\Controllers\TaskController::class, 'store']);

// get logged in  user
Route::middleware(['auth:sanctum'])->get('/user/me', [App\Http\Controllers\AuthController::class, 'me']);