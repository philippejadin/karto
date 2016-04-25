<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Contact;


/**
 * Class BatchController
 * @package App\Http\Controllers
 * 
 * Controller pour faire des actions en masse sur les contacts, par exemple supprimer plusieurs contacts ou ajouter des tags
 * 
 */

class BatchController extends Controller
{


    /**
     *
     * @param Request $request
     * @return mixed
     * 
     * La requête doit contenir au moins un tableau de check (qui sont les id des contacts)
     * et l'action à effectuer
     * 
     * Pour l'instant
     * 
     * 'delete' -> pour effacer
     * 
     */
    public function action(Request $request)
    {
        //dd($request);

        if ($request->input('action')== "delete") {
            foreach ($request->input('check') as $contact_id => $value)
            {
                   Contact::findOrFail($contact_id)->delete();
            }

            flash()->success('L\'organisme a bien été effacé');
        }


        return redirect()->route('admin.contact.index');

    }


}
