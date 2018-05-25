<?php

Route::group(['namespace' => 'Company' , 'as' => 'company.' , 'prefix' => 'company'] , function (){
    Route::get('/' , 'CompanyController@getIndex')->name('index');
    Route::get('/add' , 'CompanyController@getAdd')->name('add');
    Route::post('/add' , 'CompanyController@postAdd')->name('submit.add');
    Route::get('/show/{id}' , 'CompanyController@getShow')->name('show');

    Route::group(['middleware' => 'access.routeNeedsRole:Kỹ thuật'] , function (){
        Route::get('/edit/{id}' , 'CompanyController@getEdit')->name('edit');
        Route::post('/edit/{id}' , 'CompanyController@postEdit')->name('submit.edit');
        Route::get('/delete/{id}' , 'CompanyController@getDelete')->name('submit.delete');
    });
});