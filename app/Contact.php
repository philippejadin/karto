<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Watson\Validating\ValidatingTrait;

class Contact extends Model
{
  use ValidatingTrait;

  /*
  protected $rules = [
      'name'  => 'required',
      'address' => 'required'
  ];
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


  
}
