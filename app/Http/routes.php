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


    


    /********************** PUBLIC *****************************/


    Route::get('/', 'monAdresseController@monAdresse');
    Route::get('home', 'monAdresseController@monAdresse');




    /********************** ADMIN *****************************/

    // gestion des contacts CRUD
    Route::resource('admin/contact', 'ContactController');


    // recherche dans les contacts
    Route::get('admin/search', 'SearchController@search');

    // import depuis un fichier excel TODO
    Route::get('admin/import', 'ExcelController@getImport');
    Route::post('admin/import', 'ExcelController@postImport');


    // gestion des contacts CRUD
    Route::resource('admin/tag', 'TagController');
    Route::get('admin/contact/{contact}/delete' ,'ContactController@destroy');


    // actions en masse sur les contacts
    Route::post('admin/batch', 'BatchController@action');


    // affichage de l'historique d emodification d'un contact
    Route::get('admin/contact/{contact}/history' ,'ContactController@history');


