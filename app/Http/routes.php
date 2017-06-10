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

$app->get('/', function () use ($app) {
    return $app->version();
});
$app->group(['prefix' => 'api/v1', 'namespace' => 'App\Http\Controllers'], function($app)
{
   //get all all customers
   $app->get('customer', 'CustomerController@getAllCustomers');
   
   //get customer details by id
   $app->get('customer/{id}', 'CustomerController@getCustomer');
  
                //create new record into db
   $app->post('customer', 'CustomerController@createCustomer');
 
   //update existing customer data into db
   $app->put('customer/{id}', 'CustomerController@updateCustomer');
  
   //delete user view
   $app->delete('customer/{id}', 'CustomerController@deleteCustomer');
});
