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
Auth::routes();
//project
Route::get('/home', 'ProjectController@index_1');
Route::get('/', 'ProjectController@index_1');
Route::get('project', 'ProjectController@index');
Route::get('task/detail/{id}', 'TaskController@detail');
Route::get('project/create', 'ProjectController@create_index');
Route::get('project/{id}','ProjectController@table');
Route::get('task/create/{id}','TaskController@create_index');
Route::post('project/create', 'ProjectController@create')->name('create');
Route::post('task/create', 'TaskController@create')->name('create_task');
Route::get('/task/complete/{id}','TaskController@complete');
Route::get('/task/cancle/{id}','TaskController@cancle');
Route::get('/task/del/{id}','TaskController@del');
Route::post('funds/add', 'FundsController@add');
Route::post('project/bug_add', 'ProjectController@bug_add');
Route::get('project/bug_success/{id}', 'ProjectController@bug_success');
Route::get('project/bug_hide/{id}', 'ProjectController@bug_hide');
Route::post('/project_task_attr_edit', 'ProjectController@project_task_attr_edit');
Route::get('funds/index', 'FundsController@index');
Route::get('/task/show/{id}', 'TaskController@show');
Route::get('/user/avatar', 'UserController@avatar');
Route::get('/user/setting', 'UserController@setting');
Route::post('/user/avatar', 'UserController@changeAvatar');
Route::post('/user/resetpassword','UserController@resetpassword');
