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

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::resource('contacts', 'ContactController');


// Routes pour la partie publique (Lilian)
/*
Exemples :

search/1080-Boulevard+L%E9opold+II+44
(ou avec post)

*/











// Routes pour la partie admin (Soungui)
/*
Exemples :

admin/contact/add
admin/contact/search
admin/contact/import
admin/contact/export

etc...



*/
