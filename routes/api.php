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

Route::middleware('auth:api')->get('/todos', 'TodosController@getTodos');
Route::middleware('auth:api')->get('/tasks/', 'TaskController@getTasks');
Route::middleware('auth:api')->post('/tasks/', 'TaskController@createTask');
Route::middleware('auth:api')->put('/tasks/{task}', 'TaskController@updateTask');
Route::middleware('auth:api')->patch('/tasks/{task}', 'TaskController@updateStatus');
Route::middleware('auth:api')->delete('/tasks/{task}', 'TaskController@destroy');
