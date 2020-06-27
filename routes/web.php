<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->group(['prefix' => 'auth'], function() use ($router) {
    $router->post('register', 'AuthController@register');
    $router->post('login', 'AuthController@login');
});

$router->group(['middleware' => 'auth'], function() use ($router) {
    $router->group(['prefix' => 'user'], function() use ($router) {
        $router->get('/', 'UserController@detail');
        $router->post('/', 'UserController@edit');
    });

    $router->group(['prefix' => 'movie'], function() use($router) {
        $router->get('/', 'MovieController@get');
        $router->get('/{id}', 'MovieController@detail');
        $router->post('/', 'MovieController@create');
        $router->post('/{id}', 'MovieController@edit');
        $router->delete('/{id}', 'MovieController@delete');
    });
});