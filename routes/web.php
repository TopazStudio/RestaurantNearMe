<?php

Route::get('/', 'PagesController@index');

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Auth::routes();

Route::resource('cuisine','CuisineController');

Route::resource('restaurants','RestaurantController');