<?php

Route::group(['middleware' => ['web', 'role:admin,access_backend', 'menu'], 'prefix' => 'admin'], function () {
    Route::group(['middleware' => 'web', 'namespace' => 'Modules\MenuBuilder\Http\Controllers'], function () {
        Route::resource('menubuilder', 'MenuBuilderController');
    });
});

