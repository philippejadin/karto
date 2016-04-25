<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Excel;


/**
 * 
 * Classe qui est remplacée par la commande karto:import
 * 
 * TODO : faire une interface d'import qui marche par le web et pas en ligne de commande
 * 
 * Class ExcelController
 * @package App\Http\Controllers
 * 
 */
class ExcelController extends Controller
{
    public function getImport()
    {
        return view('admin.import');

    }

    public function postImport()
    {

        Excel::load(Input::file('file'), function ($reader) {

            $reader->each(function($sheet) {
                foreach ($sheet->toArray() as $row) {
                    Contact::firstOrCreate($row);

                }
            });
        });
        echo "Bien jouer!!!";
    }

}
