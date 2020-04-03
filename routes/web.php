<?php

Route::get('/', function () {
    return view('welcome');
})->name('main.index');

Route::middleware(['admin'])->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/', 'Admin\FrontController@index')->name('index');
    });
});

Auth::routes();

