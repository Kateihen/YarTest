<?php

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
	return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('projects', 'ProjectController');

Route::get('/projects/{project_id}/tasks/create', 'TaskController@create');
Route::post('/projects/{project_id}/tasks', 'TaskController@store');
Route::get('/projects/{project_id}/{status}', 'TaskController@index');
Route::get('/projects/{project_id}/{status}/{task_id}', 'TaskController@show');
Route::get('/projects/{project_id}/tasks/{task_id}/edit', 'TaskController@edit');
Route::patch('/projects/{project_id}/tasks/{task_id}', 'TaskController@update');
Route::delete('/projects/{project_id}/tasks/{task_id}/delete', 'TaskController@destroy');
Route::get('/projects/{project_id}/tasks/{task_id}/{filename}', 'TaskController@download');
