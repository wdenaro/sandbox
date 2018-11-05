<?php


Route::get('editor', 'miscController@editor')
    ->name('editor');


Route::post('process-edit', 'miscController@process_edit')
    ->name('process.edit');


Route::get('foobar', 'miscController@foobar')
    ->name('foobar');


Route::get('fees', 'miscController@fees')
    ->name('fees');


Route::get('/', 'miscController@index');
