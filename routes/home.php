<?php
//Auth
Route::get('/','HomeController@index');
Route::get('/dang-nhap','LoginController@dangnhap');
Route::post('/dang-nhap-post','LoginController@dangnhappost');
Route::post('/dang-ki-post','LoginController@dangkipost');
Route::get('/dang-xuat','LoginController@dangxuat');
//Profile
Route::get('account','ProfileController@account');
Route::post('/update-account','ProfileController@updateaccount');
Route::post('/account/edit-password','ProfileController@editpass');

//Home
Route::get('/gia-soc','HomeController@giasoc');
Route::get('/danh-muc/{url}','HomeController@category');
Route::get('/san-pham/{url}','HomeController@product');
Route::post('/filter-product/{url}','HomeController@filter');
Route::get('/bai-viet/{id}','HomeController@blog');

//Cart
Route::post('add-cart','CartController@add');
Route::get('view-cart','CartController@view');
Route::post('removeCart','CartController@removeCart');
Route::get('updateCart','CartController@updateCart');
//Step
Route::get('cart/step', 'CheckoutController@step');
Route::post('cart/step-continue', 'CheckoutController@stepcontinue');
Route::post('cart/check-out', 'CheckoutController@checkout');
Route::get('cart/thanks', 'CheckoutController@thank');
//Introl
Route::get('introl/{url}', 'HomeController@introl');
//Contac
Route::get('contact', 'HomeController@contact');
Route::post('contact-post', 'HomeController@contactpost');
//Search
Route::get('/search', 'HomeController@search');
