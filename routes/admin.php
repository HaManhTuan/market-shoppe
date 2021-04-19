<?php
Route::get('pagenotfound', ['as' => 'notfound', 'uses' => 'AdminController@pagenotfound']);
Route::get('admin/login', 'AdminController@login');
Route::post('admin/dang-nhap', 'AdminController@dangnhap');
Route::group(['prefix' => 'admin', 'middleware' => 'Admin'], function () {
    //User
	Route::get('dashboard', 'DashboardController@index');
	Route::get('user/view', 'UserController@index');
    Route::get('user/add', 'UserController@add');
    Route::post('user/add-post-user','UserController@postadd');
    Route::get('user/edit-user/{id}','UserController@edit');
    Route::post('user/edit-post-user','UserController@postedit');
    Route::get('logout', 'AdminController@logout');
    //Profile
    Route::get('profile', 'UserController@profile');
    Route::post('post-profile', 'UserController@postprofile');
    Route::post('changepassword', 'UserController@changepassword');
    //Permissions
    Route::get('user/permissions', 'PermissionsController@index');
    Route::get('user/add-permissions', 'PermissionsController@add');
    Route::post('user/add-post-permissions', 'PermissionsController@postadd');
    Route::get('user/edit-permissions/{id}', 'PermissionsController@edit');
    Route::post('user/edit-post-permissions', 'PermissionsController@postedit');
    Route::post('user/del-post-permissions', 'PermissionsController@delete');
    //Roles
    Route::get('user/roles', 'RolesController@index');
    Route::get('user/add-roles', 'RolesController@add');
    Route::post('user/add-post-roles', 'RolesController@postadd');
    Route::get('user/edit-roles/{id}', 'RolesController@edit');
    Route::post('user/edit-post-roles', 'RolesController@postedit');
    Route::post('user/del-post-roles', 'RolesController@delete');
    //Category
    Route::group(['prefix' => 'category',  'middleware' => 'Admin'], function () {
    Route::get('view-category','CategoryController@show');
    Route::post('add','CategoryController@add');
    Route::post('edit-modal','CategoryController@showmodal');
    Route::post('edit','CategoryController@edit');
    Route::post('edit-modal','CategoryController@showmodal');
    Route::post('delete','CategoryController@delete');
    });
    //Silder
	Route::group(['prefix' => 'media', 'middleware' => 'Admin'], function () {
        Route::get('view-media', 'MediaController@view');
        Route::match(['get', 'post'], 'add-media', 'MediaController@add');
        Route::post('edit-modal', 'MediaController@editModal');
        Route::post('edit-media', 'MediaController@edit');
        Route::post('delete', 'MediaController@delete');
    });
    //Config
	Route::group(['prefix' => 'config', 'middleware' => 'Admin'], function () {
        Route::match(['get','post'],'view-config', 'ConfigController@view');
        Route::match(['get','post'],'edit-config', 'ConfigController@edit');
    });
    //Product
	Route::group(['prefix' => 'product', 'middleware' => 'Admin'], function () {
        Route::get('view-product', 'ProductController@viewpro');
        Route::get('add', 'ProductController@add');
        Route::post('add-pro', 'ProductController@addpro');
        Route::match(['get', 'post'], 'edit-pro/{url}', 'ProductController@editpro');
        Route::post('delete-pro', 'ProductController@delpro');
        Route::match(['get', 'post'], 'add-image/{url}', 'ProductController@addimg');
        Route::post('delete-img', 'ProductController@deimg');
    });
    //BLog
    Route::group(['prefix' => 'blog', 'middleware' => 'Admin'], function () {
        Route::get('view-blog', 'BlogController@viewblog');
        Route::get('add', 'BlogController@add');
        Route::post('add-blog', 'BlogController@addblog');
        Route::match(['get', 'post'], 'edit-blog/{id}', 'BlogController@editblog');
        Route::post('delete-blog', 'BlogController@delblog');
    });
    //Brand
    Route::group(['prefix' => 'brand', 'middleware' => 'Admin'], function () {
        Route::get('view-brand', 'BrandController@viewbrand');
        Route::get('add', 'BrandController@add');
        Route::post('add-brand', 'BrandController@addbrand');
        Route::match(['get', 'post'], 'edit-brand/{id}', 'BrandController@editbrand');
        Route::post('delete-brand', 'BrandController@delbrand');
    });
    //LandingPage
     Route::group(['prefix' => 'landingpage', 'middleware' => 'Admin'], function () {
        Route::get('view', 'LandingPageController@view');
        Route::get('add', 'LandingPageController@add');
        Route::post('add-landing', 'LandingPageController@addlanding');
        Route::match(['get', 'post'], 'edit-landing/{id}', 'LandingPageController@editlanding');
        // Route::post('delete-brand', 'BrandController@delbrand');
    });
     //Contact
    Route::group(['prefix' => 'contact', 'middleware' => 'Admin'], function () {
        Route::get('view', 'ContactController@view');
        Route::post('view-modal', 'ContactController@modal');
    });
    //Order
    Route::group(['prefix' => 'order', 'middleware' => 'Admin'], function () {
        Route::get('view', 'OrderController@view');
        Route::get('view-orderdetail/{id}', 'OrderController@vieworder');
        Route::post('change-customer', 'OrderController@changecustomer');
        Route::post('change-status', 'OrderController@changestatus');
        Route::get('invoice/{id}', 'OrderController@invoice');
        Route::get('send-mail/{id}', 'OrderController@sendEMail');
    });
    Route::group(['prefix' => 'customer', 'middleware' => 'Admin'], function () {
        Route::get('view', 'CustomerController@view');
        Route::post('view-modal', 'CustomerController@viewmodal');
    });

});
?>
