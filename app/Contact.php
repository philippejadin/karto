<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Watson\Validating\ValidatingTrait;
use Geocoder;
use App\Tag;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
  use ValidatingTrait;
  use \Venturecraft\Revisionable\RevisionableTrait;
  use SoftDeletes;


  protected $dontKeepRevisionOf = [
    'country',
    'latitude',
    'longitude',
    'geocode_status'
  ];

  protected $rules = [
    'name'  => 'required',
    'address' => 'required'
  ];




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
    'uuid',
    'prefix'
  ];

  public $geocode_message;


  // on renvoit d'office un pays par défaut, ce qui aide le géocodage
  public function getCountryAttribute($value)
  {
    if (empty($value))
    {
      return env('DEFAULT_COUNTRY', 'Belgique');
    }
    return $value;
  }



  public function getNameAttribute($value)
  {
    return trim(preg_replace('/[\x0D]/', '', $value));
  }


  // Filtrage du html de description
  public function getDescriptionAttribute($value)
  {

    return preg_replace('/[\x0D]/', '', strip_tags($value, '<p><h1><h2><h3><h4><br><strong><em><img><ul><li><span><div>'));

  }



  public function summary($length = 200)
  {
    return preg_replace('/[\x0D]/', '', filter_var (str_replace(array("\n", "\t", "\r"), '',  substr(strip_tags($this->description), 0, $length)), FILTER_SANITIZE_STRING));
  }




  /**
  * Geocode le contact
  * On stocke dans geocode status où on en est  :

  * 0 = pas géocodé
  * 1 = géocodé ok
  * -10 = erreur http (erreur provisoire)
  * -20 = quota exceeded (erreur provisoire)

  * -30 = pas de résultat
  * -40 = trop de résultats
  * -50 = adresse ambigue ou de faible qualité
  * -100 = autre erreur

  */
  public function geocode($force = false)
  {
    // si on a déja essayé de géocoder et que l'erreur est persisante, pas la peine de réessayer, ça ne marchera pas
    // sauf si on force le géocodage avec $force = true
    if ($this->geocode_status < -20 && ! $force)
    {
      return false;
    }


    // generate correct country and city vars for geocode

    // toujours avoir un pays par défaut
    $country = $this->getcountryAttribute($this->country);

    // si pas de code postal on met le nom de la ville, mais sinon juste le code postal ça fonctionne mieux
    if (empty($this->postal_code))
    {
      $city = $this->locality;
    }
    else
    {
      $city = $this->postal_code;
    }


    $address = $this->address . ', ' . $city  . ', ' . $country;

    $geocode = app('geocoder')->geocode($address)->get()->first();

    if ($geocode) {

      $this->geocode_status = 1;
      $this->latitude = $geocode->getCoordinates()->getLatitude();
      $this->longitude = $geocode->getCoordinates()->getLongitude();
      return true;


    }

    $this->geocode_status = -10;
    return false;
  }


  public function tags()
  {
    return $this->belongsToMany('App\Tag', 'contact_tag', 'contact_id', 'tag_id')->orderBy('master_tag', 'desc')->orderBy('name')->withTimestamps();
  }

  public function masterTags()
  {
    return $this->belongsToMany('App\Tag')->orderBy('name')->where('master_tag', 1)->withTimestamps();
  }

  public function publicTags()
  {
    return $this->belongsToMany('App\Tag')->orderBy('master_tag', 'asc')->where('public', 1)->withTimestamps();
  }

  /**
  * Free search scope, search in all relevant fields
  * cfr. http://www.rapyd.com/rapyd-demo/customfilter?src=jhon+doe&search=1
  */
  public function scopeFreesearch($query, $value)
  {
    return $query->where('name','like','%'.$value.'%')
    ->orWhere('description','like','%'.$value.'%')
    ->orWhere('address','like','%'.$value.'%')
    ->orWhere('postal_code','like','%'.$value.'%')
    ->orWhere('locality','like','%'.$value.'%')
    ->orWhereHas('tags', function ($q) use ($value) {
      $q->where('name','like','%'.$value.'%');
    });

  }





}
