<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Contact;
use Mexitek\PHPColors\Color;

class Tag extends Model
{
    use \Venturecraft\Revisionable\RevisionableTrait;

    protected $table    = 'tags';

    protected $fillable = [
        'name',
        'description',
        'color',
        'master_tag'
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
