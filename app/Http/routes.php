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
Ici on va mettre les routes pour els personnes connectées qui fot de suggestions de modifs
*/


/********************** ADMIN *****************************/
Route::group(['middleware' => ['admin']], function () {

    // gestion des contacts CRUD
    Route::resource('admin/contact', 'ContactController');

    Route::get('admin/contact/{contact}/delete' ,['as'=>'contact.delete','uses'=>'ContactController@destroy']);
    Route::get('admin/geocoded', 'ContactController@indexGeocoded');


    // importation

    Route::get('admin/import', 'ImportController@importForm');
    Route::post('admin/import', 'ImportController@import');





    // recherche dans les contacts
    Route::get('admin/search', 'SearchController@search');

    // changement en masse des tags
    Route::get('admin/tag/change','TagController@changeForm');
    Route::post('admin/tag/change','TagController@change');

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
