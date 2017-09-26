<?php



Route::group(['middleware' => ['session']],function (){

    Auth::routes();

    Route::resource('cuisine','CuisineController');

    Route::resource('restaurants','RestaurantController');

});

Route::group(['prefix'=>'/search'],function (){
   Route::get('/index',[
       'uses'=>'SearchController@index'
   ]);

    Route::post('/complex',[
        'uses'=>'SearchController@complex'
    ]);

    Route::get('/simple/{term}',[
        'uses'=>'SearchController@simple'
    ]);
});

