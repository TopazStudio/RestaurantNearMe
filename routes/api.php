<?php



Route::group(['middleware' => ['session']],function (){

    Auth::routes();

    Route::resource('cuisine','CuisineController');

    Route::resource('restaurants','RestaurantController');

});

Route::group(['prefix'=>'/search'],function (){
   Route::get('/{entity}/index',[
       'uses'=>'SearchController@index'
   ]);

    Route::post('/{entity}/complex',[
        'uses'=>'SearchController@complex'
    ]);

    Route::get('/{entity}/simple/{term}',[
        'uses'=>'SearchController@simple'
    ]);
});

