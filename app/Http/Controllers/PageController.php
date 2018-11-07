<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function __invoke($path)
    {
        dd(explode('/',$path));
    }
}
