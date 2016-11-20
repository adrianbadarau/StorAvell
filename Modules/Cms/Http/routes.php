<?php

Route::group(['middleware' => ['web'], 'prefix'=>'cms', 'namespace' => 'Modules\Cms\Http\Controllers'], function (){
    Route::get('/blog',[
        'as' => 'cms.show',
        'uses' => 'CmsController@show'
    ]);
});

Route::group(['middleware' => ['web','role:admin,access_backend','menu'], 'prefix' => 'admin/cms', 'namespace' => 'Modules\Cms\Http\Controllers'], function()
{
    Route::resource('page', 'PagesController',['except'=> ['show']]);
});