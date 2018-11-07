<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $guarded = ['id'];
    public $timestamps = false;

    public function pages()
    {
        return $this->belongsToMany(Page::class);
    }
}
