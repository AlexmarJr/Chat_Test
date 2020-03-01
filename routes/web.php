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

Route::post('store', 'roomController@store')->name('store');
Route::post('storeComment', 'roomController@storeComment')->name('storeComment');
Route::post('set_username', 'roomController@set_username')->name('set_username');
Route::get('chat_room/Return', 'roomController@storeCommentReturn')->name('returning_chat');
Route::any('chatting_room', 'roomController@retuning_chat_room')->name('chatting_room');
Route::get('chat_room', 'roomController@chat_view')->name('chat_room');
Route::get('chat_room2/{id?}', 'roomController@chat_view2')->name('chat_room2');
Route::get('welcome_view', 'roomController@welcome_view')->name('welcome');
Route::get('chat_list', 'roomController@chat_list')->name('chat_list');
Route::get('delete/{id?}','roomController@delete')->name('delete');
