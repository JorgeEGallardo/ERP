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
Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
Route::resource('/empresas', 'EmpresasController')->middleware('empresas');
Auth::routes();



//No middleware routes
route::get('/getStates/{id}', 'auxController@getStates');
route::get('/getCities/{id}', 'auxController@getCities');

Route::get('/', function () {
    return view('welcome');
})->middleware('auth');
