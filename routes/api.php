<?php

Route::group([
    'prefix' => 'v1',
    'namespace' => 'Api'
], function() {

    Route::post('/auth/register', 'Auth\RegisterController@store');
    Route::post('/auth/token', 'Auth\AuthClientController@auth');

    Route::group([
        'middleware' => ['auth:sanctum']
    ], function() {

        Route::get('/auth/me', 'Auth\AuthClientController@me');
        Route::post('/auth/logout', 'Auth\AuthClientController@logout');

        Route::post('/auth/orders/{identifyOrder}/evaluations', 'EvaluationApiController@store');

        Route::get('/auth/my-orders', 'OrderApiController@myOrders');
        Route::post('/auth/orders', 'OrderApiController@store');

    });

    Route::get('/tenants/{uuid}', 'TenantApiController@show');
    Route::get('/tenants', 'TenantApiController@index');

    Route::get('/categories/{url}', 'CategoryApiController@show');
    Route::get('/categories', 'CategoryApiController@cateoriesByTenant');

    Route::get('/tables/{identify}', 'TableApiController@show');
    Route::get('/tables', 'TableApiController@tablesByTenant');

    Route::get('/products/{identify}', 'ProductApiController@show');
    Route::get('/products', 'ProductApiController@productsByTenant');

    Route::post('/orders', 'OrderApiController@store');
    Route::get('/orders/{identify}', 'OrderApiController@show');

});


