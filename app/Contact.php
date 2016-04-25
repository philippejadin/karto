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


    // on renvoit d'office un pays par défaut, ce qui aide le géocodage
    public function getCountryAttribute($value)
    {
        if (empty($value))
        {
            return env('DEFAULT_COUNTRY', 'Belgique');
        }
    }

/*
* Geocode le contact
*/
public function geocode()
{

    // si on a déja essayé de géocoder, pas la peine de réessayer, ça ne marche pas
    if ($this->latitude == -999)
    {
        return false;
    }

    try
    {
        $geocode = Geocoder::geocode($this->address . ', ' . $this->postal_code . ' ' . $this->locality . ' ' . $this->country);
    }
    catch (\Exception $e)
    {
        // on met arbitrairement -10000 ce qui veut dire "géocodage foiré"
        $this->latitude = -999;
        $this->longitude = -999;
        return false;
    }

    $this->latitude = $geocode['latitude'];
    $this->longitude = $geocode['longitude'];

    return true;

}

public function tags()
{

    return $this->belongsToMany('App\Tag')->withTimestamps();

}





}
