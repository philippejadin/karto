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
public function getCountryAttribute($value)
{
    if (empty($value))
    {
        return 'Belgique'; // TODO à configurer
    }
}
*/




/*
* Geocode le contact
* On stocke dans geocode status où on en est  :

0 = pas géocodé
1 = géocodé ok
-10 = erreur http (erreur provisoire)
-20 = quota exceeded (erreur provisoire)

-30 = pas de résultat
-40 = trop de résultats
-50 = adresse ambigue ou de faible qualité
-100 = autre erreur


*
*/
public function geocode($force = false)
{
    // si on a déja essayé de géocoder et que l'erreur est persisante, pas la peine de réessayer, ça ne marchera pas
    // sauf si on force le géocodage avec $force = true
    if ($this->geocode_status < -20 && ! $force)
    {
        return false;
    }

    try
    {
        $geocode = Geocoder::geocode($this->address . ', ' . $this->postal_code . ' ' . $this->locality . ' ' . $this->country); // TODO : peux mieux faire, certains géocodeurs acceptent les infos séparément
    }
    catch (\Exception $e)
    {
        if ($e instanceof HttpError)
        {
            $this->geocode_status = -10; // erreur HTTP
            return false;
        }

        if ($e instanceof QuotaExceeded )
        {
            $this->geocode_status = -20; // erreur HTTP
            return false;
        }

        if ($e instanceof NoResult)
        {
            $this->geocode_status = -30; // erreur HTTP
            return false;
        }

        if ($e instanceof ChainNoResultException)
        {
            $this->geocode_status = -30; // erreur HTTP
            return false;
        }

        $this->geocode_status = -100; // erreur HTTP
        return false;
    }


    $this->geocode_status = 1;
    $this->latitude = $geocode['latitude'];
    $this->longitude = $geocode['longitude'];
    return true;
}


public function tags()
{

    return $this->belongsToMany('App\Tag')->withTimestamps();

}





}
