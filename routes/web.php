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
Route::get('pagenotfound', ['as' => 'notfound', 'uses' => 'AdminController@pagenotfound']);
Route::get('manager/login', 'SuperAdminController@login');
Route::post('manager/dang-nhap', 'SuperAdminController@dangnhap');
Route::group(['prefix' => 'manager', 'middleware' => 'Admin'], function () {
    Route::get('/', 'DashboardManagerController@index')->name('manager.dashboard');
     //Category
    Route::get('danh-muc', 'CategoryManagerController@index')->name('manager.category');
    Route::get('danh-muc-draff', 'CategoryManagerController@draff')->name('manager.category.draff');
    Route::get('danh-muc-draff-infor/{id}', 'CategoryManagerController@draffInfo')->name('manager.category.draff.info');
    Route::post('danh-muc-draff-infor-confirm', 'CategoryManagerController@draffInfoConfirm')->name('manager.category.draff.info.confirm');
    Route::post('danh-muc-draff-infor-cancell', 'CategoryManagerController@draffInfoCancell')->name('manager.category.draff.info.cancell');
    Route::post('add-danh-muc', 'CategoryManagerController@add')->name('manager.category.add');
    Route::get('sua-danh-muc/{id}', 'CategoryManagerController@editCateModal')->name('manager.category.edit');
    Route::post('update-danh-muc', 'CategoryManagerController@edit')->name('manager.category.editPost');
    Route::post('xoa-danh-muc', 'CategoryManagerController@delete')->name('manager.category.delete');
    Route::post('update-status-danh-muc', 'CategoryManagerController@updateStatus')->name('manager.category.updateStatus');
    Route::post('update-status-cus-danh-muc', 'CategoryManagerController@updateStatusCus')->name('manager.category.updateStatusCus');
    //Brand
    Route::get('thuong-hieu', 'BrandManagerController@index')->name('manager.brand');
    Route::get('them-thuong-hieu', 'BrandManagerController@addView')->name('manager.brand.add');
    Route::post('them-thuong-hieu-do', 'BrandManagerController@add')->name('manager.brand.addPost');
    Route::post('xoa-thuong-hieu', 'BrandManagerController@delete')->name('manager.brand.delete');
    //stalls
    Route::get('gian-hang', 'StallManagerController@index')->name('manager.stalls');
    Route::get('xem-gian-hang/{id}', 'StallManagerController@view')->name('manager.stalls.view');
    Route::post('change-info', 'StallManagerController@changeInfo')->name('manager.stalls.changeInfo');
    Route::post('change-status', 'StallManagerController@changeStatus')->name('manager.stalls.changeStatus');
    Route::post('change-status-one', 'StallManagerController@changeStatusOne')->name('manager.stalls.changeStatusOne');
    Route::post('change-all-status-on-product', 'StallManagerController@changeAllStatusOnProduct')->name('manager.stalls.changeAllStatusOnProduct');
    Route::post('change-all-status-off-product', 'StallManagerController@changeAllStatusOffProduct')->name('manager.stalls.changeAllStatusOffProduct');
    //Products
    Route::get('san-pham', 'ProductManagerController@index')->name('manager.product');
    Route::post('chi-tiet-san-pham', 'ProductManagerController@detailPro')->name('manager.product.detail');
    //Email
    Route::get('cau-hinh-email', 'EmailManagerController@index')->name('manager.email');
    Route::post('cau-hinh-email-cart', 'EmailManagerController@mailCart')->name('manager.email.mailCart');
    Route::post('cau-hinh-email-pro', 'EmailManagerController@mailPro')->name('manager.email.mailPro');
    //Config
    Route::match(['get','post'],'view-config', 'ConfigManagerController@view');
    Route::match(['get','post'],'edit-config', 'ConfigManagerController@edit');
    //Contact
    Route::group(['prefix' => 'contact'], function () {
        Route::get('view', 'ContactManagerController@view');
        Route::post('view-modal', 'ContactManagerController@modal');
    });
    //
    Route::group(['prefix' => 'contact'], function () {
        Route::get('view', 'ContactManagerController@view');
        Route::post('view-modal', 'ContactManagerController@modal');
    });
    //Banner
    Route::group(['prefix' => 'media'], function () {
        Route::get('view-media', 'MediaManagerController@view');
        Route::post('edit-media', 'MediaManagerController@add');
    });
    //Comment
    Route::group(['prefix' => 'comment'], function () {
        Route::get('view-comment', 'CommentManagerController@view');
        Route::get('change-comment/{id}', 'CommentManagerController@change');
    });
    //Events
    Route::group(['prefix' => 'events'], function () {
        Route::get('view-events', 'EventManagerController@index')->name('manager.events.view');
        Route::post('add-event', 'EventManagerController@add')->name('manager.events.add');
        Route::get('change-events/{id}', 'EventManagerController@change');
    });
});
