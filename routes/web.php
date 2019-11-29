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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

// API route group
$router->group(['prefix' => 'api'], function () use ($router) {
    // Matches "/api/register
   $router->post('register', 'AuthController@register');
     // Matches "/api/login
    $router->post('login', 'AuthController@login');

    // Matches "/api/bicycles
    // $router->get('bicycles', ['middleware' => 'auth', 'uses' => 'BicycleController@allBicycles']);

    Route::group(['middleware' => 'auth'], function(){
        Route::get('bicycles', 'BicycleController@allBicycles');
        Route::post('bicycles', 'BicycleController@addBicycle');
        Route::get('bicycles/{id}', 'BicycleController@singleBicycle');
        Route::get('profile', 'UserController@profile');
        Route::get('users/{id}', ['middleware' => 'isAdminOrSelf', 'uses' => 'UserController@singleUser']);
        Route::get('users', ['middleware' => 'isAdmin', 'uses' => 'UserController@allUsers']);
        // Route::get('users', 'UserController@allUsers');
    });


});
