<?php

use Illuminate\Http\Request;

Route::post('login', 'LoginController@index');

// News
Route::middleware('jwt.auth' /*'auth:api'*/)->group(function () {
    Route::get('news', 'NewsController@index');
    Route::post('news', 'NewsController@create');
    Route::put('news/{item}', 'NewsController@update');
    Route::get('news/{item}', 'NewsController@item');
    Route::delete('news/{item}', 'NewsController@delete');
});

Route::get('/files/{file}/{hash}', 'FilesController@get');

//Handbooks
Route::get('/handbooks/categories', 'HandbooksController@categories');
