<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
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


  
}
