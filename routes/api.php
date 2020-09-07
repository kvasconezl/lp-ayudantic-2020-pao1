<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
	return $request->user();
});

Route::group(['prefix' => 'users'], function () {
	Route::get('getAlumnos', 'UserController@getAlumnos');
	Route::get('getAlumno', 'UserController@getAlumno');
	Route::get('getTutores', 'UserController@getTutores');
	Route::get('getTutor', 'UserController@getTutor');

	Route::post('setPreferido', 'UserController@setPreferido');
});


Route::group(['prefix' => 'tutorias'], function () {
	Route::get('getTutorias', 'TutoriaController@getTutorias');
	Route::get('getTutoria', 'TutoriaController@getTutoria');
	Route::get('getExpress', 'TutoriaController@getExpress');
	Route::get('getRegular', 'TutoriaController@getRegular');
	Route::post('setTutoria', 'TutoriaController@setTutoria');
});
