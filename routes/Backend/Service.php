<?php

Route::group(['namespace' => 'Service' , 'as' => 'service.' , 'prefix' => 'service'  ] , function (){
    Route::group(['middleware' => 'access.routeNeedsRole:Kỹ thuật'] , function (){
        Route::get('/' , 'ServiceController@getIndex')->name('index');
        Route::get('/add' , 'ServiceController@getAdd')->name('add');
        Route::post('/add' , 'ServiceController@postAdd')->name('submit.add');
        Route::get('/edit/{id}' , 'ServiceController@getEdit')->name('edit');
        Route::post('/edit/{id}' , 'ServiceController@postEdit')->name('submit.edit');
        Route::get('/delete/{id}' , 'ServiceController@postDelete')->name('submit.delete');
    });
});