<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('page/{path?}', 'PageController')
    ->where('path', '(.*)')
    ->name('page');

Route::get('menu', 'MenuController@index')
    ->name('menu');

Route::get('menu/{type}/{name}', 'MenuController@show')
    ->name('menu.category');
