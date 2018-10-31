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
 
// $router->get('/','ExampleController@show');
$router->post('/', 'ExampleController@postLogin'); 
$router->post('/save', 'ExampleController@save'); 
 $router->get('/test', 'ExampleController@test'); 

// $router->get('/test', ['middleware' => 'auth', function ($router) {
//  $router->get('/test', 'ExampleController@test'); 

//     // echo "here";
// }]); 
 

 