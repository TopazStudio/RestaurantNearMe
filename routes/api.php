<?php



Route::group(['middleware' => ['session']],function (){

    Auth::routes();

    Route::resource('cuisine','CuisineController');

    Route::resource('restaurants','RestaurantController');
});

