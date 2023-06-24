<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Polypost extends Model
{
    use HasFactory;

    public function photo()
    {
        return $this->morphMany('App\Models\Photo', 'imageable');
    }


    public function tags()
    {
        return $this->morphToMany('App\Models\Tag', 'taggable');
    }
}
