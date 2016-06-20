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
                        $sheet->fromModel($tag->contacts);
                    });
                }
            })->export('xls');

        }
        else
        {
            flash()->error('Il faut sélectionner au moins un tag');
            return redirect()->back();
        }
    }


}
