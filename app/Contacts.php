<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class Contacts extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'contacts';
    
    protected $fillable = [
          'name',
          'description',
          'adress',
          'postal_code',
          'locality',
          'country',
          'phone',
          'phone2',
          'website',
          'email',
          'public',
          'latitude',
          'longitude',
          'uuid'
    ];
    

    public static function boot()
    {
        parent::boot();

        Contacts::observe(new UserActionsObserver);
    }
    
    
    
    
}