<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix' => config('admin.route.prefix'),
    'namespace' => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
], function (Router $router) {
    $router->get('/', 'HomeController@index');
    $router->get('users', 'UsersController@index')->name('admin.users.index');
    $router->get('users/{id}', 'UsersController@show')->name('admin.users.show');
    $router->get('users/export/', 'UsersController@export');
    $router->get('products', 'ProductsController@index')->name('admin.products.index');
    $router->get('products/create', 'ProductsController@create');
    $router->post('products', 'ProductsController@store');
    $router->get('products/{id}/edit', 'ProductsController@edit');
    $router->get('products/{id}/', 'ProductsController@show')->name('admin.products.show');
//    $router->get('products/{id}/search', 'ProductsController@search')->name('admin.products.search');
    $router->put('products/{id}', 'ProductsController@update');
    $router->get('orders', 'OrdersController@index')->name('admin.orders.index');
    $router->get('orders/{order}', 'OrdersController@show')->name('orders.show');
    $router->post('orders/{order}/ship', 'OrdersController@ship')->name('admin.orders.ship');
    $router->post('orders/{order}/refund', 'OrdersController@handleRefund')->name('admin.orders.handle_refund');
});
