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


// #################### USER ####################

/**
 * Register user.
 */
Route::post('/user/register', [App\Http\Controllers\AuthController::class, 'register']);

/**
 * Login user.
 */
Route::post('/user/login', [App\Http\Controllers\AuthController::class, 'login']);

/**
 * Edit user.
 */
Route::post('/user/edit/{id}', [App\Http\Controllers\UserController::class, 'editUser']);

/**
 * Updates user when next character level video has already been played.
 */
Route::post('/user/update/{id}', [App\Http\Controllers\UserController::class, 'update']);

/**
 * Gets logged in user, also uses middleware.
 */
Route::middleware(['auth:sanctum'])->get('/user/me', [App\Http\Controllers\AuthController::class, 'me']);

/**
 * Gets all users.
 */
Route::get('/user/all-users', [App\Http\Controllers\UserController::class, 'getAllUsers']);

/**
 * Gets user according to ID.
 */
Route::get('/user/{id}', [App\Http\Controllers\AuthController::class, 'getUserData']);


// #################### PROJECT ####################

/**
 * Store project.
 */
Route::post('/add-project/create', [App\Http\Controllers\ProjectController::class, 'store']);

/**
 * Delete project.
 */
Route::delete('/delete-project/{id}', [App\Http\Controllers\ProjectController::class, 'destroy']);

/**
 * Lists all projects according to ID.
 */
Route::get('/projects/{id}', [App\Http\Controllers\ProjectController::class, 'showMyProjects']);

/**
 * Gets all projects according to user ID.
 */
Route::get('/project-users/{id}', [App\Http\Controllers\ProjectController::class, 'getAllProjectUsers']);

/**
 * Gets all tasks according to user ID.
 */
Route::get('/project-tasks/{id}', [App\Http\Controllers\ProjectController::class, 'getAllProjectTasks']);

/**
 * Gets project according to ID.
 */
Route::get('/project-details/{id}', [App\Http\Controllers\ProjectController::class, 'getProject']);


// #################### TASK ####################

/**
 * Sorting tasks.
 */
Route::post('/sort-task', [App\Http\Controllers\ProjectController::class, 'sort']);

/**
 * Gets all tasks.
 */
Route::get('/tasks/index/{id}', [App\Http\Controllers\TaskController::class, 'index']);

/**
 * Gets task according to ID.
 */
Route::get('/task/{id}', [App\Http\Controllers\TaskController::class, 'show']);

/**
 * Updates task according to ID.
 */
Route::get('/tasks/{id}', [App\Http\Controllers\TaskController::class, 'update']);

/**
 * Creates task according to ID.
 */
Route::post('/add-task/{id}', [App\Http\Controllers\TaskController::class, 'store']);

/**
 * Deletes task according to ID.
 */
Route::delete('/delete-task/{id}', [App\Http\Controllers\TaskController::class, 'destroy']);

/**
 * Updates task according to ID.
 */
Route::post('/edit-task/{id}', [App\Http\Controllers\TaskController::class, 'update']);

/**
 * Updates storypoints according to task ID.
 */
Route::get('/updateStoryPoints/{taskId}', [App\Http\Controllers\TaskController::class, 'updateStoryPoints']);
