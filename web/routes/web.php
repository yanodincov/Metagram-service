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



Route::group(['as' => 'metagram.'],function () {
    Route::get('/', 'MetagramController@index')->name('index');
    Route::post('/getway', 'MetagramController@getWay')->name('getWay');
    Route::post('/generate', 'MetagramController@generate')->name('generate');
});
