<?php

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




//Middleware routes

use Illuminate\Support\Facades\Route;

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
Route::get('/', 'HomeController@index')->name('home')->middleware('auth');
Route::resource('/empresas', 'EmpresasController')->middleware('empresas');
Route::resource('/compradores', 'CompradoresController')->middleware('compradores');
Auth::routes();
Route::get('/registro', 'registroController@create')->name('registro')->middleware('auth');
Route::post('/registro/create', 'registroController@store')->name('registro/create')->middleware('auth');
Route::get('/usuarios', 'registroController@index')->name('usuarios')->middleware('admin');

Route::get('/control', 'AdministradorController@index')->name('control')->middleware('admin');

Route::delete('/series/{id}', 'AdministradorController@destroy')->name('series.destroy')->middleware('admin');
//No middleware routes
route::get('/getStates/{id}', 'auxController@getStates');
route::get('/getCities/{id}', 'auxController@getCities');
route::get('/getCountries', 'auxController@getCountries');

