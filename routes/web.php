<?php
/** @var \Laravel\Lumen\Routing\Router $router */

$router->get('/', function () use ($router) {
    return $router->app->version();
});

// Define API routes
$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('/users', 'UserController@getUsers'); // Get all users
    $router->post('/users', 'UserController@add'); // Create user
    $router->get('/users/{id}', 'UserController@show'); // Get user by ID
    $router->put('/users/{id}', 'UserController@update'); // Update user
    $router->delete('/users/{id}', 'UserController@delete'); // Delete user
});

// Define duplicate routes without 'api/' prefix
$router->get('/users', 'UserController@getUsers'); // Get all users
$router->post('/users', 'UserController@add'); // Create user
$router->get('/users/{id}', 'UserController@show'); // Get user by ID
$router->put('/users/{id}', 'UserController@update'); // Update user
$router->delete('/users/{id}', 'UserController@delete'); // Delete user

$router->get('/usersjob', 'UserJobController@index');
$router->get('/userjob/{id}', 'UserJobController@show');