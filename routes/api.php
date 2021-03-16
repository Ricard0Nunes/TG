<?php

use Illuminate\Http\Request;
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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::get('/data', 'EventController@index');
Route::resource('events', 'EventController');
Route::get('/data', 'ProjetoController@gantt');
Route::resource('task', 'TasksController');
Route::resource('link', 'LinkController');
Route::get('users', 'usersController@get');
Route::get('ferias', 'EventController@indexFerias');
Route::get('dep', 'ProjetoController@get');
