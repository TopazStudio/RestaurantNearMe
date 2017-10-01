<?php

Route::get('/', 'PagesController@index');

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

//Fix for home
Route::get('/home', 'DashboardController@index')->name('home');

Auth::routes();

Route::resource('cuisine','CuisineController');

Route::resource('restaurants','RestaurantController');