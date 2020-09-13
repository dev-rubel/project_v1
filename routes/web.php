<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('auth.login');
});

Auth::routes(['register' => false]);

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
/* User Resource */
Route::resource('user', 'UserController');
/* Customer Resource */
Route::resource('customer', 'CustomerController');
/* Order Resource */
Route::resource('order', 'OrderController');
Route::post('order/printStatus', 'OrderController@printStatus')->name('order.printStatus');
/* Setting Resource */
Route::resource('setting', 'SettingController');