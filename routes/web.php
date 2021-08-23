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

$router->post('/bill/create', 'BillController@createBill');
$router->post('/bill/list', 'BillController@listBill');
$router->get('/bill/list/frequency/{frequency}', 'BillController@listBillByFrequency');

$router->get('/user/balance', 'UserController@getBalance');


