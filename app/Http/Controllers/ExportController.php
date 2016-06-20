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

            $contacts = \App\Contact::with('tags')->whereHas('tags', function($query) use ($request) {
                $query->whereIn('tags.id', $request->get('tags'));
            })->get();

            Excel::create('Filename', function($excel) use($contacts) {
                $excel->sheet('Export', function($sheet) use($contacts) {
                    $sheet->fromModel($contacts);
                });
            })->export('xls');

        }
    }


}
