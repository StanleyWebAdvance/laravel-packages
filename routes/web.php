<?php




Route::group( ['middleware' => 'guest'], function ()
{
    Route::get('/', 'KitController@index');
//    Route::post('/', 'KitController@calculate')->name('calculate');
    Route::post('/', 'KitController@order')->name('order');
});


