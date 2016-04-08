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
