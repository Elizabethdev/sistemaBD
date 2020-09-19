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


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/subirarchivo', 'DatosController@cargarArchivo')->name('uploadfile');
Route::post('/importarExcel', 'DatosController@importExcel')->name('importarExcel');
Route::get('/verdatos', 'DatosController@verDatos')->name('verdatos');
Route::get('/resumendemandas', 'DatosController@filtrarDatosdemanda')->name('resumendemanda');
Route::get('/resumenservicios', 'DatosController@filtrarDatosServicio')->name('resumenservicios');
Route::get('/resumenrango', 'DatosController@filtrarDatosRango')->name('resumenrango');
