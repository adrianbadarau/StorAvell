<?php

Route::group(['middleware' => 'web', 'prefix' => 'menubuilder', 'namespace' => 'Modules\MenuBuilder\Http\Controllers'], function()
{
    Route::get('/', 'MenuBuilderController@index');
});
