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
Auth::routes();

Route::resource('/departamentos', 'DepartamentosController')->middleware('departamentos');
Route::resource('/autorizaciones', 'AutorizacionesController')->middleware('auth');
Route::resource('/empresas', 'EmpresasController')->middleware('empresas');
Route::resource('/proveedores', 'ProveedoresController')->middleware('proveedores');
Route::resource('/articulos', 'ArticulosController')->middleware('articulos');
Route::resource('/autorizacionesCompras', 'AutorizacionesComprasController')->middleware('articulos');
Route::resource('/lineas', 'LineasController')->middleware('auth');
Route::resource('/avisos', 'AvisosController')->middleware('admin');
Route::resource('/grupos', 'GruposController')->middleware('admin');
//Usuarios
Route::get('temporal', function () {
});

Route::get('/registro', 'registroController@create')->name('registro')->middleware('admin');
Route::post('/registro/create', 'registroController@store')->name('registro/create')->middleware('admin');
Route::get('/usuarios', 'registroController@index')->name('usuarios')->middleware('admin');
Route::get('/usuario/{id}', 'registroController@Edit')->name('usuarios.Edit')->middleware('admin');
Route::put('/usuario/edit/{id}', 'registroController@usuarioEdit')->name('usuario.Edit')->middleware('admin');
Route::get('/control', 'AdministradorController@index')->name('control')->middleware('admin');
Route::get('/series/{id}', 'AdministradorController@seriesView')->name('series')->middleware('admin');
Route::get('/permisos/{id}/{name?}', 'AdministradorController@rolesView')->name('roles')->middleware('admin');
Route::delete('/permisos/{id}', 'AdministradorController@destroy')->name('permisos.destroy')->middleware('admin');
Route::put('/permisos/{id}', 'AdministradorController@PermisosEdit')->name('permisos/edit')->middleware('admin');
Route::post('/permisos', 'AdministradorController@permisosCreate')->name('permisos/edit')->middleware('admin');
Route::delete('/series/{id}', 'registroController@destroy')->name('series.destroy')->middleware('admin');
Route::delete('/serie/{id}', 'AdministradorController@serieDestroy')->name('serie.destroy')->middleware('admin');
Route::post('/series/{id}', 'AdministradorController@serieStore')->name('series.store')->middleware('admin');
Route::post('/series', 'AdministradorController@tiposSeriesCreate')->name('tiposSeriesCreate.store')->middleware('admin');
Route::post('/giros', 'AdministradorController@girosCreate')->name('giros.store')->middleware('admin');
Route::post('/clasificaciones', 'AdministradorController@clasificacionCreate')->name('clasificacion.store')->middleware('admin');
Route::post('/ubicaciones', 'AdministradorController@ubicacionesCreate')->name('ubicaciones.store')->middleware('admin');
Route::post('/tiposusuarios', 'AdministradorController@tiposUsuariosCreate')->name('tiposUsuarios.store')->middleware('admin');

//No middleware routes
route::get('/getStates/{id}', 'auxController@getStates');
route::get('/cambioEmpresa/{id}', 'auxController@empresaSesion');
route::get('/getCities/{id}', 'auxController@getCities');
route::get('/getCountries', 'auxController@getCountries');
