<?php

Route::middleware('api')->group(function () {
    Route::get('update-token', 'Api\TokenController@updateToken');

    Route::group(['prefix' => 'todos'], function (){
        Route::get('get-by-user', 'Api\TodoController@getByUser');
        Route::put('delegate-todo', 'Api\TodoController@delegateTodo');

        Route::post('add', 'Api\TodoController@addTodo');
    });

    Route::group(['prefix' => 'users'], function (){
        Route::get('get-all', 'Api\UserController@getAll');
    });
});