<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
//rutas de la tabla actors
Route::get('/actor', 'ActorController@index');
Route::post('/actor/store', 'ActorController@store');
Route::post('/actor/destroy', 'ActorController@destroy');

//rutas de la tabla movies
Route::post('/pelicula', 'MovieController@index');
Route::post('/pelicula/store', 'MovieController@store');
Route::post('/pelicula/destroy', 'MovieController@destroy');


Route::get('/gestion-peliculas', 'MovieController@show');
Route::get('/gestion-actor', 'MovieController@show');


