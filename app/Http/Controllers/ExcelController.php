<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Excel;

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
