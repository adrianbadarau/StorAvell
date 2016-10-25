<?php

Route::group(['middleware' => 'web', 'namespace' => 'Modules\Templating\Http\Controllers'], function()
{
    Route::get('/', 'TemplatingController@index');
});

Route::group(['middleware' => 'web', 'prefix'=>'admin','namespace'=>'Modules\Templating\Http\Controllers'], function (){
    Route::get('/', 'TemplatingController@admin');
});
