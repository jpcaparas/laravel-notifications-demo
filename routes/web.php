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

Route::group(['prefix' => 'notifications', 'namespace' => 'Notifications'], function() {
    Route::get('nexmo/{user}', 'NexmoController')->name('notifications.nexmo');
    Route::get('db/{user}', 'DbController')->name('notifications.db');
});
