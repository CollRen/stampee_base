<?php
use App\Controllers;
use App\Routes\Route;


Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');


Route::get('/user', 'UserController@index');
Route::get('/user/show', 'UserController@show');

Route::get('/user/create', 'UserController@create');
Route::post('/user/create', 'UserController@store');

Route::get('/user/edit', 'UserController@edit');
Route::post('/user/edit', 'UserController@update');
Route::post('/user/delete', 'UserController@delete');



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



Route::get('/actualite', 'ActualiteController@index');
Route::get('/actualite/show', 'ActualiteController@show');

Route::get('/actualite/create', 'ActualiteController@create');
Route::post('/actualite/create', 'ActualiteController@store');

Route::get('/actualite/edit', 'ActualiteController@edit');
Route::post('/actualite/edit', 'ActualiteController@update');
Route::post('/actualite/delete', 'ActualiteController@delete');



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



Route::get('/enchereFavorie', 'EnchereFavorieController@index');
Route::get('/enchereFavorie/show', 'EnchereFavorieController@show');

Route::get('/enchereFavorie/create', 'EnchereFavorieController@create');
Route::post('/enchereFavorie/create', 'EnchereFavorieController@store');

Route::get('/enchereFavorie/edit', 'EnchereFavorieController@edit');
Route::post('/enchereFavorie/edit', 'EnchereFavorieController@update');
Route::post('/enchereFavorie/delete', 'EnchereFavorieController@delete');



Route::get('/enchere', 'EnchereController@index');
Route::get('/enchere/show', 'EnchereController@show');

Route::get('/enchere/create', 'EnchereController@create');
Route::post('/enchere/create', 'EnchereController@store');

Route::get('/enchere/edit', 'EnchereController@edit');
Route::post('/enchere/edit', 'EnchereController@update');
Route::post('/enchere/delete', 'EnchereController@delete');

Route::get('/enchere/mesencheres', 'EnchereController@mesencheres');
Route::get('/enchere/archive', 'EnchereController@index');
Route::get('/enchere/active', 'EnchereController@index');
Route::get('/enchere/mesencheresfavorites', 'EnchereController@index');
Route::get('/enchere/mesencheresfavorites', 'EnchereController@mesencheresfavorites');


Route::get('/enchereclient', 'EnchereController@filtre');
Route::get('/enchereclient/filtre', 'EnchereController@filtre');

Route::get('/enchere/create', 'EnchereController@create');
Route::post('/enchere/create', 'EnchereController@store');





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

