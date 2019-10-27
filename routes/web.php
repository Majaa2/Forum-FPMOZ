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

Route::get('/home', 'ThreadController@index')->name('home');


Route::get('/threads', 'ThreadController@index')->name('threads.index');
Route::get('/threads/create', 'ThreadController@create')->name('threads.create');
Route::get('/threads/store', 'ThreadController@store')->name('threads.store');
Route::get('/threads/thread/{id}', 'ThreadController@thread')->name('threads.thread');
Route::get('/threads/edit/{id}', 'ThreadController@edit')->name('threads.edit');
Route::get('/threads/update/{id}', 'ThreadController@update')->name('threads.update');
Route::get('/threads/delete/{id}', 'ThreadController@delete')->name('threads.delete');
Route::get('/search', 'ThreadController@search')->name('threads.search');

Route::get('/threads/thread/comment/{id}','CommentsController@create')->name('comment.create');
Route::get('/threads/thread/comment/delete/{id}', 'CommentsController@delete')->name('comment.delete');

Route::get('/users', 'UsersController@index')->name('users.index');
Route::get('/users/edit/{id}', 'UsersController@edit')->name('users.edit');
Route::get('/users/update/{id}', 'UsersController@update')->name('users.update');
Route::get('/users/delete/{id}', 'UsersController@delete')->name('users.delete');
Route::get('/users/user/{id}', 'UsersController@prof')->name('users.user');

