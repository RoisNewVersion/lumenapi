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

$app->post('login', ['as'=>'login', 'uses'=>'UserController@postLogin']);
$app->post('register', ['as'=>'register', 'uses'=>'UserController@register']);

$app->group(['middleware'=>'auth', 'namespace'=> 'App\Http\Controllers'], function() use($app){
	// user
	$app->get('user/{id}', ['as'=>'user', 'uses'=>'UserController@getUser']);
	// book
	$app->get('books', 'BooksController@index');
	$app->get('books/{id}', 'BooksController@show');
	$app->post('books', 'BooksController@store');
	$app->put('books/{id}', 'BooksController@update');
	$app->delete('books/{id}', 'BooksController@delete');
});
