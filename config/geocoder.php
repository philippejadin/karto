<?php

use Geocoder\Provider\Chain\Chain;
use Geocoder\Provider\GeoPlugin\GeoPlugin;
use Geocoder\Provider\Nominatim\Nominatim;
use Http\Client\Curl\Client;

return [

    /*
    |--------------------------------------------------------------------------
    | Cache Duration
    |--------------------------------------------------------------------------
    |
    | Specify the cache duration in minutes. The default approximates a forever
    | cache, but there are certain issues with Laravel's forever caching
    | methods that prevent us from using them in this project.
    |
    | Default: 9999999 (integer)
    |
    */
    'cache-duration' => 99999999,

    /*
    |--------------------------------------------------------------------------
    | Providers
    |--------------------------------------------------------------------------
    |
    | Here you may specify any number of providers that should be used to
    | perform geocaching operations. The `chain` provider is special,
    | in that it can contain multiple providers that will be run in
    | the sequence listed, should the previous provider fail. By
    | default the first provider listed will be used, but you
    | can explicitly call subsequently listed providers by
    | alias: `app('geocoder')->using('google_maps')`.
    |
    | Please consult the official Geocoder documentation for more info.
    | https://github.com/geocoder-php/Geocoder#providers
    |
    */

    'providers' => [
        Chain::class => [
            Nominatim::class  => ['https://nominatim.openstreetmap.org', 'Agorakit'],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Adapter
    |--------------------------------------------------------------------------
    |
    | You can specify which PSR-7-compliant HTTP adapter you would like to use.
    | There are multiple options at your disposal: CURL, Guzzle, and others.
    |
    | Please consult the official Geocoder documentation for more info.
    | https://github.com/geocoder-php/Geocoder#usage
    |
    | Default: Client::class (FQCN for CURL adapter)
    |
    */
    'adapter'  => Client::class,

];
