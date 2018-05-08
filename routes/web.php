<?php
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/profile/{user}', 'UserController@show')->name('user.show');
Route::get('/weight/{user}', 'WeightController@index');
Route::post('/weight/{user}', 'WeightController@store');
Route::delete('/weight/{user}/{weight}', 'WeightController@destroy');
Route::get('/graphData/{days}', 'WeightController@graphData')->middleware('auth');