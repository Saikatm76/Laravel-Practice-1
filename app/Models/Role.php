<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public function users()
    {

        // return $this->belongsToMany('App\Models\User', 'user_role', 'role_id', 'user_id');   #we can also use it like this

        return $this->belongsToMany('App\Models\User')->withPivot('created_at');  //withPivot add some extra data in 'pivot table'
    }
}
