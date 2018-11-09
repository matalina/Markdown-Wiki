<?php

namespace App\Http\Controllers;

use App\Category;
use App\Page;
use App\Tag;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $categories = Category::get();
        $tags = Tag::get();

        $menu = [];
        foreach($categories as $c) {
            $menu['category'][] = $c->category;
        }
        foreach($tags as $t) {
            $menu['tags'][] = $t->tag;
        }

        return response()->json($menu);
    }

    public function show($type, $name)
    {
        switch($type) {
            case 'category':
            case 'categories':
                $pages = Page::whereHas('categories',function($query) use ($name){
                    $query->where('category','=',$name);
                })->orderBy('title','asc')->get();
                break;
            case 'tag':
            case 'tags':
                $pages = Page::whereHas('tags',function($query) use ($name){
                    $query->where('tag','=',$name);
                })->orderBy('title','asc')->get();
                break;
            case 'pages':
            case 'page':
                if($name == 'all') {
                    $pages = Page::orderBy('title','asc')->get();
                }
                else {
                    $pages = Page::where('title', 'like', $name . '%')->orderBy('title', 'asc')->get();
                }
                break;
            default:
                return abort('404','This information does not exist.');
        }
        $menu = [];
        foreach($pages as $p) {
            $path = str_replace('.md','',$p->location);
            $path = str_replace('.md','',$p->location);
            $menu[$path] = $p->title;
        }

        return response()->json($menu);
    }
}
