<?php

use Illuminate\Support\Facades\Artisan;

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

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->post('/register', 'AuthController@register');
    $router->post('/login', 'AuthController@login');
    $router->get('/logout', 'AuthController@logout');

    $router->group(['prefix' => 'boards', 'middleware' => 'auth'], function () use ($router) {
        $router->get('/', 'BoardController@index');
        $router->post('/create', 'BoardController@store');
        $router->put('/{board}/update', 'BoardController@update');
        $router->delete('/{board}/delete', 'BoardController@destroy');
    });

    $router->group(['prefix' => 'lists', 'middleware' => 'auth'], function () use ($router) {
        $router->get('/{board}', 'ListController@index');
        $router->post('/create/{board}', 'ListController@store');
        $router->put('/{lists}/update', 'ListController@update');
        $router->delete('/{lists}/delete', 'ListController@destroy');
    });

    $router->group(['prefix' => 'tasks', 'middleware' => 'auth'], function () use ($router){
        $router->get('/{lists}', 'TaskController@index');
        $router->post('create/{lists}', 'TaskController@store');
        $router->patch('/{task}/update', 'TaskController@update');
        $router->delete('{task}/delete', 'TaskController@destroy');
    });
});

$router->get('/artisan/{command}[/{params}]', function ($command, $params = null) {
    Artisan::call($command, $params ? explode(',', $params) : []);
});