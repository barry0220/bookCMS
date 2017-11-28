<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/',function(){
    return redirect('admin/types');
});

//    Route::group(['middleware'=>'login','prefix'=>'admin','namespace'=>'Admin'],function(){
Route::group(['prefix'=>'admin','namespace'=>'Admin'],function(){
    Route::resource('/login','LoginController');
    Route::resource('/user','UserController');
    Route::resource('/books','BooksController');
    Route::resource('/booksman','BooksManController');
    Route::resource('/types','TypeController');
});