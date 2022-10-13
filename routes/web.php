<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('task-list');
});

Route::get('/task-list', "TaskController@view");
Route::post('/add-task', "TaskController@addTask");
Route::post('/edit-task', "TaskController@editTask");
Route::post('/remove-task', "TaskController@removeTask");
Route::post('/order-task', "TaskController@orderTask");