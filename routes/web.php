<?php
/* Main App landing page */

Route::get('/', 'AppController')
    ->name('home');

/* Api get functions */

Route::get('page/{path?}', 'PageController')
    ->where('path', '(.*)')
    ->name('page');

Route::get('menu', 'MenuController@index')
    ->name('menu');

Route::get('menu/{type}/{name}', 'MenuController@show')
    ->name('menu.category');