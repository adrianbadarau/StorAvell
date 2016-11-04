<?php

Route::group(['middleware' => ['web'], 'prefix'=>'product', 'namespace' => 'Modules\Category\Http\Controllers'], function (){
    Route::get('/{category}',[
        'as' => 'category.show',
        'uses' => 'CategoryController@show'
    ]);
});

Route::group(['middleware' => ['web','role:admin,access_backend','menu'], 'prefix' => 'admin', 'namespace' => 'Modules\Category\Http\Controllers'], function()
{
    Route::resource('category', 'CategoryController',['except'=> ['show']]);
});