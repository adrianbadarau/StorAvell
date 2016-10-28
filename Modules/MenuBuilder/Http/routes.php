<?php

Route::group(['middleware' => ['web', 'role:admin,access_backend', 'menu'], 'prefix' => 'admin'], function () {
    Route::group(['middleware' => 'web', 'prefix' => 'menubuilder', 'namespace' => 'Modules\MenuBuilder\Http\Controllers'], function () {
        Route::get('/', 'MenuBuilderController@index');
    });
});

