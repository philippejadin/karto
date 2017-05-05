<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;

class SearchController extends Controller
{

    /**
    * Affiche un formulaire de recherche pour les recherches avancées
    */
    public function searchForm()
    {

    }

    /**
    * Affiche les résultats de la recherche
    */
    public function search(Request $request)
    {

        $keywords = $request->get('keywords');

        // chercher dans la DB
        //$contacts = \App\Contact::where('name', 'like', '%' . $keyword . '%')->paginate(20);


        $contacts = \App\Contact::hydrateRaw("
        SELECT *, MATCH (name, description, postal_code, locality, website, email) AGAINST
        (" . DB::connection()->getPdo()->quote($keywords) . "IN NATURAL LANGUAGE MODE) AS score
        FROM contacts WHERE MATCH (name, description, postal_code, locality, website, email) AGAINST
        (". DB::connection()->getPdo()->quote($keywords) . "IN NATURAL LANGUAGE MODE) limit 0, 20");

        /*dd ($contacts);

        $contacts = DB::select("
        SELECT *, MATCH (name, description, postal_code, locality, website, email) AGAINST
        ('pms wavre'
        IN NATURAL LANGUAGE MODE) AS score
        FROM contacts WHERE MATCH (name, description, postal_code, locality, website, email) AGAINST
        ('pms wavre'
        IN NATURAL LANGUAGE MODE)");

        */



        // afficher la vue avec les résultats
        return view('contact.search')
        ->with('keywords', $keywords)
        ->with('contacts', $contacts);

    }
}
