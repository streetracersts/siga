<?php

Auth::routes();
Route::view('/', 'welcome');
Route::view('pessoas', 'pessoas');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/exibepessoas', 'PessoaController@index');
Route::post('/armazenarpessoa', 'PessoaController@store');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
