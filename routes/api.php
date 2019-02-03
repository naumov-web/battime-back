<?php

use Illuminate\Http\Request;

Route::post('login', 'LoginController@index');

// News
Route::middleware('jwt.auth' /*'auth:api'*/)->group(function () {
    Route::get('news', 'NewsController@index');
    Route::post('news', 'NewsController@create');
    Route::put('news/{item}', 'NewsController@update');
    Route::put('news/{item}/show', 'NewsController@show');
    Route::put('news/{item}/hide', 'NewsController@hide');
    Route::get('news/{item}', 'NewsController@item');
    Route::delete('news/{item}', 'NewsController@delete');

    Route::get('banners', 'BannersController@index');
    Route::post('banners', 'BannersController@create');
    Route::put('banners/{item}', 'BannersController@update');
    Route::get('banners/{item}', 'BannersController@item');
    Route::delete('banners/{item}', 'BannersController@delete');

    Route::get('questions', 'QuestionsController@index');
    Route::post('questions', 'QuestionsController@create');
    Route::put('questions/{item}', 'QuestionsController@update');
    Route::put('questions/{item}/enable', 'QuestionsController@enable');
    Route::put('questions/{item}/disable', 'QuestionsController@disable');
    Route::get('questions/{item}', 'QuestionsController@item');
    Route::delete('questions/{item}', 'QuestionsController@delete');

});

Route::get('/files/{file}/{hash}', 'FilesController@get');

//Handbooks
Route::get('/handbooks/categories', 'HandbooksController@categories');
Route::get('/handbooks/banner-places', 'HandbooksController@bannerPlaces');
