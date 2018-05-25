<?php

Route::group(['prefix' => 'personnel', 'as' => 'personnel.', 'namespace' => 'Personnel'], function (){
    Route::group(['prefix' => 'users', 'as' => 'users.'], function (){
        Route::get('/', 'UsersController@getIndex')->name('index');
        Route::get('view/{id}', 'UsersController@getView')->name('getView');
        Route::get('get-curl', 'UsersController@getCURL');

        Route::group(['middleware' => 'access.routeNeedsRole:Giám đốc;Trưởng phòng;Kỹ thuật'], function() {
            Route::get('add', 'UsersController@getAdd')->name('getAdd');
            Route::post('add', 'UsersController@postAdd')->name('postAdd');
            Route::get('excel', 'UsersController@getExcel')->name('getExcel');
        });

        Route::group(['middleware' => 'access.routeNeedsRole:Nhân viên;Kỹ thuật'], function() {
            Route::get('edit/{id}', 'UsersController@getEdit')->name('getEdit');
            Route::post('edit/{id}', 'UsersController@postEdit')->name('postEdit');
        });

        Route::group(['middleware' => 'access.routeNeedsRole:Kỹ thuật'], function() {
            Route::get('delete/{id}', 'UsersController@getDelete')->name('getDelete');
        });

    });

    Route::group(['prefix' => 'revenues', 'as' => 'revenues.'], function (){
        Route::get('get/{uid}', 'RevenueController@getIndex')->name('index');

//        Route::group(['middleware' => 'access.routeNeedsRole:Nhân viên;Giám đốc;Trưởng phòng;Kỹ thuật'], function() {
            Route::get('add', 'RevenueController@getAdd')->name('getAdd');
            Route::post('add', 'RevenueController@postAdd')->name('postAdd');
            Route::post('/ajax/suggestion' , 'RevenueController@postAjaxSuggestion')->name('ajax.suggestion');
            Route::post('/ajax/suggestion/detail' , 'RevenueController@postAjaxSuggestionDetail')->name('ajax.suggestion.detail');
//        });

        Route::group(['middleware' => 'access.routeNeedsRole:Nhân viên,Kỹ thuật'], function() {
            Route::get('edit/{id}', 'RevenueController@getEdit')->name('getEdit');
            Route::post('edit', 'RevenueController@postEdit')->name('postEdit');
        });

    });

    Route::group(['prefix' => 'business', 'as' => 'business.'], function (){
        Route::get('/plan-business{page?}' , 'BusinessController@getPlanBusiness')->name('plan.business');

        Route::group(['middleware' => 'access.routeNeedsRole:Giám đốc;Trưởng phòng;Kỹ thuật'], function() {
            Route::get('/search-plan-business' , 'BusinessController@searchPlanBusiness')->name('search.plan.business');
        });


        Route::get('/{page?}', 'BusinessController@getIndex')->name('index');

        Route::group(['middleware' => 'access.routeNeedsRole:Giám đốc;Trưởng phòng;Kỹ thuật'], function() {
            Route::get('excel/{page?}', 'BusinessController@ajaxBusinessChangeField')->name('oderBy.report');
        });

        Route::post('business-change-field/{page?}', 'BusinessController@ajaxBusinessChangeField')->name('ajax.business.change.field');

        Route::group(['middleware' => 'access.routeNeedsRole:Kỹ thuật'], function() {
            Route::get('add-goals', 'BusinessController@getAddGoals')->name('getAddGoals');
            Route::post('add-goals', 'BusinessController@postAddGoals')->name('postAddGoals');
        });

    });


    Route::group(['prefix' => 'documents', 'as' => 'documents.'], function () {

        Route::group(['middleware' => 'access.routeNeedsRole:Giám đốc;Trưởng phòng;Kỹ thuật'], function() {
            Route::get('add', 'DocumentsController@getAdd')->name('getAdd');
            Route::post('add', 'DocumentsController@postAdd')->name('postAdd');

            Route::get('edit/{id}', 'DocumentsController@getEdit')->name('getEdit');
            Route::post('edit/{id}', 'DocumentsController@postEdit')->name('postEdit');

            Route::get('delete/{id}', 'DocumentsController@getDelete')->name('getDelete');
        });

        Route::get('/', 'DocumentsController@getIndex')->name('index');
        Route::get('{detail}', 'DocumentsController@getDetail')->name('getDetail');
    });

});