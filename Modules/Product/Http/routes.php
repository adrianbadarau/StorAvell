<?php
Route::group(['middleware' => ['web'], 'prefix'=>'product', 'namespace' => 'Modules\Product\Http\Controllers'], function (){
    Route::get('/{product}',[
        'as' => 'product.show',
        'uses' => 'ProductController@show'
    ]);
});

Route::group(['middleware' => ['web','role:admin,access_backend','menu'], 'prefix' => 'admin', 'namespace' => 'Modules\Product\Http\Controllers'], function()
{
    Route::resource('product', 'ProductController',['except'=> ['show']]);
});
