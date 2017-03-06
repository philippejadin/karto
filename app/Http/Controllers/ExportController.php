<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Excel;

class ExportController extends Controller
{

    /*
    Affichage formulaire d'export :

    - choix des tags
    - bouton submit
    */
    public function form(Request $request)
    {
        return view('admin.export')
        ->with('tags', \App\Tag::all());
    }


    public function export(Request $request)
    {
        if ($request->has('tags'))
        {
            // une requête par tag et donc un onglet par tag dans le fichier excell, c'est soit disant plus lent, mais plus simple :
            $tags = \App\Tag::find($request->get('tags'));



            Excel::create('Filename', function($excel) use($tags) {
                foreach ($tags as $tag)
                {
                    $excel->sheet($tag->name, function($sheet) use($tag) {
                        $contacts = $tag->contacts()->with('tags')->get();

                        $contacts_array = array();
                        foreach ($contacts as $contact)
                        {
                            $contact_array = $contact->toArray();
                            $contact_array['tags'] = implode(',', $contact->tags->lists('name')->all());
                            $contact_arrays[] = $contact_array;
                        }

                        $sheet->fromArray($contact_arrays,null,'A1',true,true);




                    });
                }
            })->export('xls');

        }
        else
        {

            // le code suivant exporte tout si aucun tag n'est sélectionné :

            Excel::create('export.xls', function($excel) {

                $excel->sheet('Export', function($sheet)  {
                    $contacts = \App\Contact::with('tags')->get();


                    $contacts_array = array();
                    foreach ($contacts as $contact)
                    {
                        $contact_array = $contact->toArray();
                        $contact_array['tags'] = implode(',', $contact->tags->lists('name')->all());
                        $contact_arrays[] = $contact_array;
                    }

                    $sheet->fromArray($contact_arrays,null,'A1');

                });

            })->export('xls');

        }
    }


}
