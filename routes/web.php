<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

use StorAvell\Http\Controllers\Auth\AuthController;

Route::get('/', 'AngularController@serveApp');
Auth::routes();
Route::get('/unsupported-browser', 'AngularController@unsupported');
