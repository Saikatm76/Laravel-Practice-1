<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'body'
    ];

    protected $dates = ['deleted_at'];



    protected $table = 'posts';
    protected $primaryKey = 'id';

    public function user()
    {

        return $this->belongsTo('App\Models\User');
    }
}
