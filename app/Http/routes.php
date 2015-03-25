<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/prueba', function(){
	return 'Prueba';
});


Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'users' => 'UsersController',
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);


Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function(){ //Ponemos 'namespace' => 'Admin' nada más porque en el Prividers/RouteServiceProvider.php ya indicamos que el namespace era 'App\Http\Controllers'

	Route::resource('users', 'UsersController');

});

