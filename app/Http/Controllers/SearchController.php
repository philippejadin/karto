<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

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

        $keyword = $request->get('keyword');
        
        // chercher dans la DB
        $contacts = \App\Contact::where('name', 'like', '%' . $keyword . '%')->paginate(20);


        // afficher la vue avec les résultats
        return view('admin.contact.index', compact('contacts'));

    }
}
