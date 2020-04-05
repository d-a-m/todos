<?php

Route::middleware('api')->group(function () {
    Route::get('update-token', 'Api\TokenController@updateToken');

    Route::group(['prefix' => 'todos'], function (){
        Route::post('get-by-user', 'Api\TodoController@getByUser');
        Route::post('delegate-todo', 'Api\TodoController@delegateTodo');
    });

    Route::group(['prefix' => 'users'], function (){
        Route::post('get-all', 'Api\UserController@getAll');
    });
});