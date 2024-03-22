<?php
use App\Controllers;
use App\Routes\Route;

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@home');

Route::get('/user/create', 'UserController@create');
Route::post('/user/create', 'UserController@store');



Route::get('/timbre', 'TimbreController@index');
Route::get('/timbre/show', 'TimbreController@show');

Route::get('/timbre/create', 'TimbreController@create');
Route::post('/timbre/create', 'TimbreController@store');

Route::get('/timbre/pdf', 'TimbreController@pdf');
Route::get('/timbre/edit', 'TimbreController@edit');
Route::post('/timbre/edit', 'TimbreController@update');
Route::post('/timbre/delete', 'TimbreController@delete');



Route::get('/etat', 'EtatController@index');
Route::get('/etat/show', 'EtatController@show');

Route::get('/etat/create', 'EtatController@create');
Route::post('/etat/create', 'EtatController@store');

Route::get('/etat/edit', 'EtatController@edit');
Route::post('/etat/edit', 'EtatController@update');
Route::post('/etat/delete', 'EtatController@delete');



Route::get('/categorie', 'TimbreCategorieController@index');
Route::get('/categorie/show', 'TimbreCategorieController@show');

Route::get('/categorie/create', 'TimbreCategorieController@create');
Route::post('/categorie/create', 'TimbreCategorieController@store');

Route::get('/categorie/edit', 'TimbreCategorieController@edit');
Route::post('/categorie/edit', 'TimbreCategorieController@update');
Route::post('/categorie/delete', 'TimbreCategorieController@delete');


Route::get('/pays', 'PaysController@index');
Route::get('/pays/show', 'PaysController@show');

Route::get('/pays/create', 'PaysController@create');
Route::post('/pays/create', 'PaysController@store');

Route::get('/pays/edit', 'PaysController@edit');
Route::post('/pays/edit', 'PaysController@update');
Route::post('/pays/delete', 'PaysController@delete');



Route::get('/enchereCat', 'EnchereCatController@index');
Route::get('/enchereCat/show', 'EnchereCatController@show');

Route::get('/enchereCat/create', 'EnchereCatController@create');
Route::post('/enchereCat/create', 'EnchereCatController@store');

Route::get('/enchereCat/edit', 'EnchereCatController@edit');
Route::post('/enchereCat/edit', 'EnchereCatController@update');
Route::post('/enchereCat/delete', 'EnchereCatController@delete');



Route::get('/enchere', 'EnchereController@index');
Route::get('/enchere/show', 'EnchereController@show');

Route::get('/enchere/create', 'EnchereController@create');
Route::post('/enchere/create', 'EnchereController@store');

Route::get('/enchere/edit', 'EnchereController@edit');
Route::post('/enchere/edit', 'EnchereController@update');
Route::post('/enchere/delete', 'EnchereController@delete');



Route::get('/timbrehasenchere', 'TimbrehasenchereController@index');
Route::get('/timbrehasenchere/show', 'TimbrehasenchereController@show');

Route::get('/timbrehasenchere/create', 'TimbrehasenchereController@create');
Route::post('/timbrehasenchere/create', 'TimbrehasenchereController@store');

Route::get('/timbrehasenchere/edit', 'TimbrehasenchereController@edit');
Route::post('/timbrehasenchere/edit', 'TimbrehasenchereController@update');
Route::post('/timbrehasenchere/update', 'TimbreController@show');
Route::post('/timbrehasenchere/delete', 'TimbrehasenchereController@delete');



Route::get('/login', 'AuthController@index');
Route::post('/login', 'AuthController@store');
Route::get('/logout', 'AuthController@delete');



Route::dispatch();
?>

