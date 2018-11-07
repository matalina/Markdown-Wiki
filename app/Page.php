<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    public $guarded = ['id'];

    public function categories() {
        return $this->belongsToMany(Category::class);
    }

    public function tags() {
        return $this->belongsToMany(Tag::class);
    }

    public function indices() {
        return $this->hasMany(Index::class);
    }

    public static function checksum($file_contents)
    {
        return md5($file_contents);
    }

    public function check($checksum)
    {
        return $this->checksum === $checksum;
    }
}
