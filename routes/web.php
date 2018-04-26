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
Route::get('/profile/{user}', 'UserController@show')->name('user.show');
Route::get('/weight/{user}', 'WeightController@index')->middleware('auth');
Route::post('/weight/{user}', 'WeightController@store')->middleware('auth');
Route::get('/graphData/{user}', 'WeightController@graphData')->middleware('auth');