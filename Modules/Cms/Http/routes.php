<?php

Route::group(['middleware' => ['web'], 'prefix'=>'cms', 'namespace' => 'Modules\Cms\Http\Controllers'], function (){
    Route::get('/blog',[
        'as' => 'cms.show',
        'uses' => 'CategoriesController@index'
    ]);
});

Route::group(['middleware' => ['web','role:admin,access_backend','menu'], 'prefix' => 'admin/cms', 'namespace' => 'Modules\Cms\Http\Controllers'], function()
{
    Route::resource('page', 'PagesController',['except'=> ['show']]);
    Route::resource('post', 'PostsController', ['except' => ['show']]);
    Route::resource('category', 'CategoriesController', ['except' => ['show'],'as'=>'cms']);
});