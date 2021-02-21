<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/**
 * Endpoints para usuário
 */
$router->group([
    'prefix' => 'api/user',
], function() use($router) {
    $router->post('/', 'Api\UserController@store');
});

/**
 * Endpoints para usuário
 */
$router->group([
    'prefix' => 'api/user',
    'middleware' => 'auth:api',
], function() use($router) {
    $router->get('/{id}', 'Api\UserController@show');
});



/**
 * Endpoints para transacoes
 */
$router->group([
    'prefix' => 'api/deposit',
    'middleware' => 'auth:api',
], function() use($router) {
    $router->post('/', 'Api\DepositController@store');
});

/**
 * Endpoints para transacoes
 */
$router->group([
    'prefix' => 'api/transaction',
    'middleware' => 'auth:api',
], function() use($router) {
    $router->post('/', 'Api\TransactionController@store');
});