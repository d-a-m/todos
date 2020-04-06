<?php

Route::middleware('api')->group(function () {
    Route::get('update-token', 'Api\TokenController@updateToken');

    Route::group(['prefix' => 'todos'], function (){
        Route::get('get-by-user', 'Api\TodoController@getByUser')->name('todo.get.by-user');
        Route::put('delegate-todo', 'Api\TodoController@delegateTodo');

        Route::post('add', 'Api\TodoController@addTodo')->name('todo.add');
        Route::patch('edit', 'Api\TodoController@editTodo')->name('todo.edit');
        Route::delete('delete', 'Api\TodoController@deleteTodo')->name('todo.delete');
    });

    Route::group(['prefix' => 'users'], function (){
        Route::get('get-all', 'Api\UserController@getAll');
    });
});