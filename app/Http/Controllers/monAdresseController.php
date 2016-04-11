<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use App\Http\Controllers\Controller;

class monAdresseController extends Controller
{
    //taper son addresse 
    public function monAdresse(Request $request)
    {
        
       
        /*$contact = DB::select('select name, address, postal_code, categorie from contacts where postal_code = ? order by categorie', array(1070));*/

        $postal_code = $request->get('postal_code');

        $contacts = \App\Contact::where('postal_code', '=', $postal_code)->paginate(20);

        return view('adresse.monAdresse')
        ->with('contacts', $contacts);
    }
}
