<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use App\Http\Controllers\Controller;
use Toin0u\Geocoder\Facade\Geocoder;
use App\Contact;

class monAdresseController extends Controller
{
    //taper son addresse 
    public function monAdresse(Request $request)
    {
        //récupérer l'adresse rentrée par l'utilisateur
   	    $keyword = $request->get('keyword');


    	//la géocoder
        try 
        {
            $results = Geocoder::geocode($keyword); 
        } 
        catch (\Exception $e) 
        {
            // No exception will be thrown here
            dd($e->getMessage());
        }

<<<<<<< HEAD
        
        //variable de calcul de distance 
        $distance = 0.01506 * 10; // == 10 km
=======
        //dd($results);
        
        $distance = 0.01506 * 10; // 10 km
>>>>>>> origin/master

    	//faire une recherche de proximité
        $contacts = \App\Contact::where('longitude', '<', $results['longitude'] + $distance / 2)
                        ->where('longitude', '>', $results['longitude'] - $distance / 2)
                        ->where('latitude', '<', $results['latitude'] + $distance / 2)
                        ->where('latitude', '>', $results['latitude'] - $distance / 2)
                        ->paginate(50);


       // dd($contacts);
    	//l'afficher
    	return view('adresse.monAdresse')
        ->with('contacts', $contacts)
<<<<<<< HEAD
        ->with('results', $results)
        ->with('keyword', $keyword);




=======
        ->with('results', $results);
>>>>>>> origin/master
    }


}
