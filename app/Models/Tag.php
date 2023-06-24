<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;


    public function polyposts()   #this is like hey 'polypost' wants you
    {
        return $this->morphedByMany('App\Models\Polypost', 'taggable');
    }

}
