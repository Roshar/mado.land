<?php

//public group routes

Route::group([], function(){

    Route::match(['get','post'],'/',['uses' => 'IndexController@execute', 'as' => 'home']);
    Route::get('/page/{alias}',['uses' => 'PageController@execute','as' => 'page' ]);

    Route::auth();

});

//admin group routes

Route::group(['prefix' => 'admin','middleware' => 'auth'], function () {

    Route::get('/',function () {

    });
    //work with pages
    Route::group(['prefix' => 'pages'],function(){
        //main page with lists
        Route::get('/',['uses' => 'PageController@execute', 'as' => 'pages']);
        //admin/pages/add
        Route::match(['get','post'],'/add',['uses' => 'PageAddController@execute', 'as' => 'pageAdd']);
        //admin/pages/edit
        Route::match(['get','post','delete'],'/edit/{page}',['uses' => 'PageEditController@execute', 'as' => 'pageEdit']);
    });
    //work with portfolios
    Route::group(['prefix' => 'portfolios'], function() {
        //main list portfolios
        Route::get('/', ['uses' => 'PortfolioController@execute','as' => 'portfolio']);
        Route::match(['get','post'],'/add',['uses' => 'PortfolioAddController@execute','as' => 'portfolioAdd']);
        Route::match(['get','post','delete'],'/edit/{portfolio}',['uses' => 'PortfolioEditController@execute', 'as' => 'portfolioEdit']);

    });

    //work with services
    Route::group(['prefix' => 'services'], function() {
        //main list services
        Route::get('/', ['uses' => 'ServiceController@execute','as' => 'service']);
        Route::match(['get','post'],'/add',['uses' => 'ServiceAddController@execute','as' => 'ServiceAdd']);
        Route::match(['get','post','delete'],'/edit/{portfolio}',['uses' => 'ServiceEditController@execute', 'as' => 'ServiceEdit']);

    });

});