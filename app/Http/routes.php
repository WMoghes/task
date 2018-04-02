<?php

Route::post('/login', 'LoginController@postLogin')->name('login');
Route::post('api/login', 'ApiLoginController@postLogin');

Route::get('/login', 'LoginController@getLogin');

Route::post('/register', 'LoginController@postRegister');
Route::post('api/register', 'ApiLoginController@postRegister');

Route::get('/register', 'LoginController@getRegister')->name('register');

Route::get('/logout', 'HomeController@logout');

Route::get('search', [
    'uses' => 'GuestController@search',
    'as' => 'guest_search'
]);
Route::get('api/search', 'ApiGuestController@search');


Route::get('api/display-product/{id}', 'ApiGuestController@displayProduct');
Route::get('product/display-product/{id}', 'GuestController@displayProduct')->name('display_product');

//Route::auth();

Route::group(['middleware' => ['client', 'auth']], function () {

    Route::get('/client/my-shopping-cart', [
        'uses' => 'OrderController@getShoppingCart',
        'as' => 'get_shopping_cart'
    ]);

    Route::get('/client/add-to-cart/{id}', [
        'uses' => 'OrderController@addToCart',
        'as' => 'add_to_cart'
    ]);

    Route::get('/client/remove-from-cart/{id}', [
        'uses' => 'OrderController@removeFromCart',
        'as' => 'remove_from_cart'
    ]);

    Route::get('/client/all-orders', [
        'uses' => 'OrderController@getAllOrders',
        'as' => 'all_orders'
    ]);

    Route::post('/client/checkout', [
        'uses' => 'OrderController@checkout',
        'as' => 'checkout'
    ]);

});

Route::group(['prefix' => 'admin/api'], function () {
    Route::get('/products', 'ApiProductController@getProducts');
    Route::get('/product/{id}', 'ApiProductController@productDisplay');
    Route::post('/product-create', 'ApiProductController@productCreate');
    Route::post('/product-update/{id}', 'ApiProductController@productUpdate');
    Route::post('/product-remove/{id}', 'ApiProductController@productRemove');
    Route::get('/product-search/{productId}', 'ApiProductController@productSearch');
    Route::post('/product-publish/{id}', 'ApiProductController@productPublish');
});

Route::group(['middleware' => ['admin', 'auth'], 'prefix' => 'admin'], function () {
    Route::get('/', [
        'uses' => 'AdminController@index',
        'as' => 'dashboard'
    ]);
    // ------------------------------------ Client Section ------------------------------------ //
    Route::get('clients', [
        'uses' => 'ClientController@getClients',
        'as' => 'admin_clients'
    ]);

    Route::get('client/{id}/{modelType}', [
        'uses' => 'ClientController@displayClient',
        'as' => 'display_client'
    ]);

    Route::post('client-update/{id}', [
        'uses' => 'ClientController@updateClient',
        'as' => 'update_client'
    ]);

    Route::post('client-remove/{id}', [
        'uses' => 'ClientController@removeClient',
        'as' => 'remove_client'
    ]);

    Route::get('client-search/{email}', [
        'uses' => 'ClientController@searchClient',
        'as' => 'search_email'
    ]);
    // ------------------------------------ End Client Section --------------------------------- //
    // ------------------------------------ Product Section ------------------------------------ //
    Route::get('products', [
        'uses' => 'ProductController@getProducts',
        'as' => 'admin_products'
    ]);

    Route::get('product/{id}/{modelType}', [
        'uses' => 'ProductController@productDisplay',
        'as' => 'product_display'
    ]);

    Route::post('product-create', [
        'uses' => 'ProductController@productCreate',
        'as' => 'product_create'
    ]);

    Route::post('product-update/{id}', [
        'uses' => 'ProductController@productUpdate',
        'as' => 'product_update'
    ]);

    Route::post('product-remove/{id}', [
        'uses' => 'ProductController@productRemove',
        'as' => 'product_remove'
    ]);

    Route::get('product-search/{productId}', [
        'uses' => 'ProductController@productSearch',
        'as' => 'product_search'
    ]);

    Route::post('product-publish/{id}', [
        'uses' => 'ProductController@productPublish',
        'as' => 'product_publish'
    ]);
    // ------------------------------------ End Product Section ------------------------------------ //
    // ------------------------------------ Order Section ------------------------------------ //
    Route::get('orders', [
        'uses' => 'OrderController@getOrders',
        'as' => 'admin_orders'
    ]);

    Route::get('order/{id}/{modelType}', [
        'uses' => 'OrderController@getOrderById',
        'as' => 'show_order'
    ]);

    Route::post('order/{id}/{orderStatus}', [
        'uses' => 'OrderController@changeOrderStatus',
        'as' => 'change_order_status'
    ]);

    Route::get('order-search/{orderId}', [
        'uses' => 'OrderController@orderSearch',
        'as' => 'order_search'
    ]);
    // ------------------------------------ End Order Section ------------------------------------ //
});

Route::get('api', 'ApiGuestController@index');
Route::get('/{type?}', 'GuestController@index')->name('homepage');

