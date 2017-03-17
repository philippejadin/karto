<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Contact;
use Mexitek\PHPColors\Color;
use Watson\Validating\ValidatingTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{

    use ValidatingTrait;
    use \Venturecraft\Revisionable\RevisionableTrait;
    use SoftDeletes;

    protected $table    = 'tags';

    protected $fillable = [
        'name',
        'description',
        'color',
        'master_tag',
        'public'
    ];


    protected $rules = [
        'name'  => 'required'
    ];

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];


    public function contacts(){

        return $this->belongsToMany('App\Contact')->withTimestamps();
    }



    public function getColorAttribute($value)
    {
        if (empty($value))
        {
            return '#aaa';
        }
        return $value;
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
