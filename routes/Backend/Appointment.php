<?php

Route::group(['prefix' => 'appointment' , 'as' => 'appointment.' , 'namespace' => 'Appointment'] , function (){

    Route::get('/', 'AppointmentController@index')->name('index');
    Route::get('/add', 'AppointmentController@getAdd')->name('add');
    Route::post('/add', 'AppointmentController@postAdd')->name('submit.add');
    Route::get('/edit/{id}', 'AppointmentController@getEdit')->name('edit');
    Route::post('/edit/{id}', 'AppointmentController@postEdit')->name('submit.edit');
    Route::get('/delete/{id}', 'AppointmentController@getDelete')->name('delete');

    Route::get('/agree/{id}' , 'AppointmentController@getAgree')->name('agree');
    Route::get('/cancel/{id}' , 'AppointmentController@getCancel')->name('cancel');
    Route::get('/allCancel' , 'AppointmentController@getAllCancel')->name('all.cancel');

});