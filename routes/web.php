<?php
/* Main App landing page */

Route::get('/', 'AppController')
    ->name('home');

/* Api get functions */

Route::get('page/{path?}', 'PageController')
    ->where('path', '(.*)')
    ->name('page');

Route::get('menu', 'MenuController')
    ->name('menu');