<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::auth();

Route::group(['middleware' => ['web']], function () {



    Route::get('test', function ()
    {
        /*
        $contacts = \App\Contact::whereNull('longitude')->orWhereNull('latitude')->take(5)->get();
        dd($contacts);
        */


        $geocode = Geocoder::geocode('5 rue de dublin, 1050 Ixelles');
        // The GoogleMapsProvider will return a result
        dd($geocode['latitude']);

    });




    


    /********************** PUBLIC *****************************/

    Route::get('/', function () {
        return view('welcome');
    });



    /********************** ADMIN *****************************/

    // gestion des contacts CRUD
    Route::resource('admin/contact', 'ContactController');


    // recherche dans les contacts
    Route::get('admin/search', 'SearchController@search');

});
