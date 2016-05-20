<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Contact;
use Watson\Validating\ValidatingTrait;

class Tag extends Model
{

    use ValidatingTrait;
    use \Venturecraft\Revisionable\RevisionableTrait;

    protected $table    = 'tags';

    protected $fillable = [
        'name',
        'description',
        'color',
        'master_tag'
    ];

     protected $rules = [
        'name'  => 'required|unique'
    ];

    public function contacts(){

        return $this->belongsToMany('App\Contact')->withTimestamps();
    }

}
