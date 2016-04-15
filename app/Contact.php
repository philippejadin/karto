<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Watson\Validating\ValidatingTrait;
use Toin0u\Geocoder\Facade\Geocoder;

class Contact extends Model
{
  use ValidatingTrait;


  /*
  protected $rules = [
      'name'  => 'required',
      'address' => 'required',
      'postal_code' => 'required',
      'email' => 'email'
  ];
  */



  protected $dates = ['deleted_at'];
  protected $table    = 'contacts';

  protected $fillable = [
    'name',
    'description',
    'address',
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


  /*
  * Geocode le contact
  */
  public function geocode()
  {
    try
    {
      $geocode = Geocoder::geocode($this->address . ', ' . $this->postal_code . ' ' . $this->locality . ' ' . $this->country);
      $this->latitude = $geocode['latitude'];
      $this->longitude = $geocode['longitude'];
      return true;
    }
    catch (\Exception $e)
    {
      return false;
    }
  }

  public function tags()
  {
    return $this->belongsToMany('App\Tag')->withTimestamps();
  }





}
