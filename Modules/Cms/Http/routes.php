<?php

Route::group(['middleware' => ['web'], 'prefix'=>'cms', 'namespace' => 'Modules\Cms\Http\Controllers'], function (){
    Route::get('/{cms}',[
        'as' => 'cms.show',
        'uses' => 'CmsController@show'
    ]);
});

Route::group(['middleware' => ['web','role:admin,access_backend','menu'], 'prefix' => 'admin', 'namespace' => 'Modules\Cms\Http\Controllers'], function()
{
    Route::resource('cms', 'CmsController',['except'=> ['show']]);
});