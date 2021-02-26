<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'product'], function () use($router) { 
    $router->get('/', 'ProductController@index');
    $router->get('/{$product}', 'ProductController@show');
    $router->post('/', 'ProductController@store');
    $router->put('/{$product}', 'ProductController@store');
    $router->delete('/{$product}', 'ProductController@destroy');
});

$router->group(['prefix' => 'sell'], function () use($router) { 
    $router->get('/', 'SellController@index');
    $router->get('/{$sell}', 'SellController@show');
    $router->post('/', 'SellController@store');
    $router->put('/{$sell}', 'SellController@store');
    $router->delete('/{$sell}', 'SellController@destroy');
});

$router->post(
    'auth/login', 
    [
       'uses' => 'AuthController@authenticate'
    ]
);

$router->group(
    ['middleware' => 'jwt.auth'], 
    function() use ($router) {
        $router->get('users', function() {
            $users = \App\User::all();
            return response()->json($users);
        });
    }
);