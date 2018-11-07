<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Index extends Model
{
    public $guarded = ['id'];
    public $timestamps = false;

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
