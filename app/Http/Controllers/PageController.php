<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Storage;

class PageController extends Controller
{
    public function __invoke($path = null)
    {
        if($path == null) {
            return $this->getPage('home');
        }
        else if(preg_match_all('#^[a-z0-9\/\-_]+$#', $path)) {
            return $this->getPage($path);
        }
        else {
            return abort('404','Page does not exist.');
        }
    }

    protected function getPage($path)
    {
        $storage = Storage::disk('wiki');
        $file = $path.'.md';

        if($storage->exists($file)) {
            $contents = $storage->get($file);

            $data = parseFile($contents);

            return response()->json($data);
        }
        else {
            return abort('404', "Page does not exist.");
        }
    }
}
