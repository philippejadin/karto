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
Route::get('tag/{tag}', 'publicTagController@show');
Route::get('contact/{contact}', 'publicContactController@show');


/********************** USERS *****************************/

/*
Ici on va mettre les routes pour els personnes connectées qui fot de suggestions de modifs
*/


/********************** ADMIN *****************************/
Route::group(['middleware' => ['admin']], function () {
    // gestion des contacts CRUD
    Route::get('admin/contact/{contact}/delete' ,'ContactController@destroy');
    Route::resource('admin/contact', 'ContactController');


    // recherche dans les contacts
    Route::get('admin/search', 'SearchController@search');

    // gestion des tags CRUD
    Route::get('admin/tag/change','TagController@changeForm');
    Route::post('admin/tag/change','TagController@change');
    Route::resource('admin/tag', 'TagController');



    // import depuis un fichier excel TODO
    /*
    Route::get('admin/import', 'ExcelController@getImport');
    Route::post('admin/import', 'ExcelController@postImport');
    */



    // actions en masse sur les contacts
    Route::post('admin/batch', 'BatchController@action');

    // affichage de l'historique de modification d'un contact
    Route::get('admin/contact/{contact}/history' ,'ContactController@history');


    // export de contacts par tags
    Route::get('admin/export' ,'ExportController@form');
    Route::post('admin/export' ,'ExportController@export');



});
