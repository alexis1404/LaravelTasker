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
    return view('home');
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
    Route::get('delete_task/{id}', 'PrivateRoomController@deleteTask')->name('deleteTask');
    Route::get('edit_page/{id}', 'PrivateRoomController@editPage')->name('editPage');
    Route::post('edit_task/{id}', 'PrivateRoomController@editTask')->name('editTask');
    Route::get('account_room', 'PrivateRoomController@accPage')->name('accPage');
    Route::post('edit_user/{id}', 'PrivateRoomController@editAccount')->name('editAccount');

});


Route::group(['middleware' => 'admin'], function () {

    //Admin controllers
    Route::get('admin', 'AdminController@index')->name('adminPage');
    Route::get('admin/get_users', 'AdminController@users')->name('adminGetUsers');
    Route::get('admin/get_user_task/{id}', 'AdminController@getUserTasks')->name('adminGetUserTask');
    Route::get('admin/delete_task/{id}', 'AdminController@deleteTask')->name('adminDeleteTask');
    Route::get('admin/get_task/{id}', 'AdminController@getTask')->name('adminGetTask');
    Route::post('admin/edit_task/{id}', 'AdminController@editTask')->name('adminEditTask');
    Route::get('admin/get_user/{id}', 'AdminController@getUser')->name('adminGetUser');
    Route::post('admin/edit_user/{id}', 'AdminController@editUser')->name('adminEditUser');

});
