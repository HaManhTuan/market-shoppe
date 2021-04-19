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

Route::get('manager/login', 'SuperAdminController@login')->middleware('checkLoginManager');
Route::post('manager/dang-nhap', 'SuperAdminController@dangnhap');
Route::group(['prefix' => 'manager', 'middleware' => 'Admin'], function () {
    Route::get('/', 'DashboardManagerController@index')->name('manager.dashboard');
});
