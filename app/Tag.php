<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table    = 'tags';

    protected $fillable = [
        'name',
        'description',
        'color',
    ];

    public function contacts(){

        return $this->belongsToMany('App\Contact')->withTimestamps();

    }
}
