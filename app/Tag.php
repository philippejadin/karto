<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Contact;
use Mexitek\PHPColors\Color;
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
        'name'  => 'required|unique',
        'color' => 'required|unique'
    ];


    public function contacts(){

        return $this->belongsToMany('App\Contact')->withTimestamps();
    }


    public function getColor()
    {

        if (empty($this->color))
        {
            return new Color("#aaa");
        }
        else
        {
            return new Color($this->color);
        }

    }

}
