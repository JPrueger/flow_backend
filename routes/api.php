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
Route::post('user/register', [App\Http\Controllers\AuthController::class, 'register'])->middleware('cors');

// login user
Route::post('user/login', [App\Http\Controllers\AuthController::class, 'login'])->middleware('cors');

