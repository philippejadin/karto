<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Contact;

class Tag extends Model
{
    use \Venturecraft\Revisionable\RevisionableTrait;

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
