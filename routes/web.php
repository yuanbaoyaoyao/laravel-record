<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'PagesController@root')->name('root');

Auth::routes(['verify' => true]);

Route::group(['middleware' => ['auth','verified']],function(){
    Route::get('user_info', 'UserInfoController@index')->name('user_info.index');
    Route::get('user_info/create','UserInfoController@create')->name('user_info.create');
    Route::post('user_info','UserInfoController@store')->name('user_info.store');
    Route::get('user_info/{user_info}','UserInfoController@edit')->name('user_info.edit');
    Route::put('user_info/{user_info}', 'UserInfoController@update')->name('user_info.update');
});
