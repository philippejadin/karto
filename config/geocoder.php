<?php

/**
 * This file is part of the GeocoderLaravel library.
 *
 * (c) Antoine Corcy <contact@sbin.dk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Ivory\HttpAdapter\CurlHttpAdapter;
use Ivory\HttpAdapter\Guzzle6HttpAdapter;
use Geocoder\Provider\Chain;
use Geocoder\Provider\BingMaps;
use Geocoder\Provider\FreeGeoIp;
use Geocoder\Provider\GoogleMaps;
use Geocoder\Provider\OpenStreetMap;
use Geocoder\Provider\MaxMindBinary;

return [
    'providers' => [
        Chain::class => [
            GoogleMaps::class => [
                'fr-FR',
                'Belgique',
                true,
                env('GOOGLE_MAPS_API_KEY'),
            ],
            OpenStreetMap::class => [],
            FreeGeoIp::class  => [],
        ],
        BingMaps::class => [
            'fr-FR',
            env('BING_MAPS_API_KEY'),
        ],
        GoogleMaps::class => [
            'fr',
            'fr-FR',
            true,
            env('GOOGLE_MAPS_API_KEY'),
        ],
    ],
    'adapter'  => CurlHttpAdapter::class,
];
