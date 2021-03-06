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

Route::get('home', 'DashboardController@index');
Route::get('/', 'DashboardController@index');
Route::get('tag/{tag}', 'publicTagController@show');
Route::get('tags', 'publicTagController@overview');
Route::get('contact/{contact}', 'publicContactController@show');


/********************** USERS *****************************/

/*
Ici on va mettre les routes pour les personnes connectées qui font de suggestions de modifs
*/


/********************** ADMIN *****************************/
Route::group(['middleware' => ['admin']], function () {


    // Effacement en masse des contacts (par tag)
    Route::get('admin/contact/massdelete','MassDeleteController@massDeleteForm');
    Route::post('admin/contact/massdelete','MassDeleteController@massDelete');

    // gestion des contacts CRUD
    Route::resource('admin/contact', 'ContactController');
    // delete avec un simple get
    Route::get('admin/contact/{contact}/delete' ,['as'=>'contact.delete','uses'=>'ContactController@destroy']);


    ///******************************* différents listes pour aider les administrateurs *************/

    // list des contacts pas géocodés
    Route::get('admin/geocoded', 'ReportController@geocoded');

    // liste des doublons
    Route::get('admin/duplicates', 'ReportController@duplicates');

    // non taggés
    Route::get('admin/untagged', 'ReportController@untagged');

    // avec uniquement un master tag
    Route::get('admin/withonlymastertag', 'ReportController@withOnlyMasterTag');



    // importation

    Route::get('admin/import', 'ImportController@importForm');
    Route::post('admin/import', 'ImportController@import');




    // recherche dans les contacts
    Route::get('admin/search', 'SearchController@search');

    // changement en masse des tags
    Route::get('admin/tag/change','TagController@changeForm');
    Route::post('admin/tag/change','TagController@change');


    // gestion des tags
    Route::resource('admin/tag', 'TagController');



    // gestionnaire d'utilisateurs
    Route::resource('admin/user', 'UserController');



    // actions en masse sur les contacts
    Route::post('admin/batch', 'BatchController@action');

    // affichage de l'historique de modification d'un contact
    Route::get('admin/contact/{contact}/history' ,'ContactController@history');


    // export de contacts par tags
    Route::get('admin/export' ,'ExportController@form');
    Route::post('admin/export' ,'ExportController@export');



});
