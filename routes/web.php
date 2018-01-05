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

Route::get('404',['as'=>'404','uses'=>'ErrorHandlerController@errorCode404']);
Route::get('405',['as'=>'405','uses'=>'ErrorHandlerController@errorCode405']);

Route::get('/', function () {
    return view('layouts.main');
});

//register routes
Route::get('register_page', 'AuthController@registerPage')->name('registerPage');
Route::post('register', 'AuthController@registerForm')->name('registerForm');

//authorization routes
Route::get('auth_page', 'AuthController@authPage')->name('authPage');
Route::post('auth_form', 'AuthController@authForm')->name('authForm');

//logout
Route::get('logout', 'AuthController@logout')->name('logout');




Route::group(['middleware' => 'checker'], function () {

    //Private room controllers
    Route::get('private_room', 'PrivateRoomController@index')->name('privatePage');
    Route::post('create_task', 'PrivateRoomController@createTask')->name('createTask');


});
