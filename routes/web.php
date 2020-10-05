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

Route::view('/inicio', 'website/home')->name('inicio');
Route::view('/', 'website/home')->name('/');
// Route::view('/aguapotable', 'website/aguapotable')->name('aguapotable');
Route::view('/alcantarillado', 'website/alcantarillado')->name('alcantarillado');
Route::view('/saneamiento', 'website/saneamiento')->name('saneamiento');
Route::view('/calidadagua', 'website/calidadagua')->name('calidadagua');

Route::prefix('/')->group(function () {
    Route::get('aguapotable', 'AguaPotableController@index')->name('aguapotable');

});

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('admin')->group(function () {
    Route::get('/subirarchivo', 'DatosController@cargarArchivo')->name('uploadfile');
    Route::post('/importarExcel', 'DatosController@importExcel')->name('importarExcel');
    Route::get('/verdatos', 'DatosController@verDatos')->name('verdatos');
    Route::get('/resumendemandas', 'DatosController@filtrarDatosdemanda')->name('resumendemanda');
    Route::get('/resumenservicios', 'DatosController@filtrarDatosServicio')->name('resumenservicios');
    Route::get('/resumenrango', 'DatosController@filtrarDatosRango')->name('resumenrango');
});

Route::prefix('api')->group(function () {
    Route::post('/consultaapmun', 'AguaPotableController@consultarByMun')->name('consultarByMun');
    Route::post('/consultaapconsejo', 'AguaPotableController@consultarByconsejo')->name('consultarByconsejo');
    Route::post('/consultaapsubcuenca', 'AguaPotableController@consultarBysubcuenca')->name('consultarBysubcuenca');
    Route::post('/consultaapregion', 'AguaPotableController@consultarByregion')->name('consultarByregion');

});

