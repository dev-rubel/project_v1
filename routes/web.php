<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
})->middleware(['guest']);

Auth::routes(['register' => false]);

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
/* User Resource */
Route::resource('user', 'UserController');
/* Customer Resource */
Route::resource('customer', 'CustomerController');
/* Order Resource */
Route::resource('order', 'OrderController');
Route::post('order/printStatus', 'OrderController@printStatus')->name('order.printStatus');
Route::get('order/printPage/{id}', 'OrderController@printPage')->name('order.printPage');
/* Setting Resource */
Route::resource('setting', 'SettingController');