<?php

Route::group(['middleware' => 'web', 'namespace' => 'Modules\Templating\Http\Controllers'], function()
{
    Route::get('/', 'TemplatingController@index');
});

Route::group(['middleware' => ['web','role:admin,access_backend','menu'], 'prefix'=>'admin','namespace'=>'Modules\Templating\Http\Controllers'], function (){
    Route::get('/', 'TemplatingController@admin');
});
