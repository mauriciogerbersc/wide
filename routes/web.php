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
Auth::routes();

Route::get('/', 'HomeController@index')->name('home');;

Route::get('/bot', 'BotControlador@list');
Route::get('/bot/{id}', 'BotControlador@show');

Route::get('/url/cadastro', 'ControladorUrls@create');
Route::post('/url/cadastro', 'ControladorUrls@store');
Route::get('/url/deletar/{id}', 'ControladorUrls@destroy');
Route::get('/url/editar/{id}', 'ControladorUrls@edit');
Route::post('/url/update/{id}', 'ControladorUrls@update');


