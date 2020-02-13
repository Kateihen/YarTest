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

Route::get('/projects/{id}/tasks/create', 'TaskController@create');
Route::post('/projects/{id}/tasks', 'TaskController@store');
Route::get('/projects/{id}/{status}', 'TaskController@index');
