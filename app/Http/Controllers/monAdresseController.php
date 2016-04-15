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
        ///CODE DE GEOLOCALISATION
        //récupérer l'adresse rentrée par l'utilisateur
   	    $keyword = $request->get('keyword');

    	//la géocoder
        //try and catch pour s'assurer qu'elle est bien géoloc
        // !!faire l'entrée de l'adresse de manière plus structurée!!
        try 
        {
            $results = Geocoder::geocode($keyword); 
        } 
        catch (\Exception $e) 
        {
            // No exception will be thrown here
            dd($e->getMessage());
        }

        //debug (dd == dump and die)
        /*dd($results);*/
        
        //vairiable de calcul de distance 
        $distance = 0.01506 * 10; // == 10 km

    	//faire une recherche de proximité
        $contacts = \App\Contact::where('longitude', '<', $results['longitude'] + $distance)
                        ->where('longitude', '>', $results['longitude'] - $distance)
                        ->where('latitude', '<', $results['latitude'] + $distance)
                        ->where('latitude', '>', $results['latitude'] - $distance)
                        ->paginate(50);
        
        //debug (dd == dump and die)
        /*dd($contacts);*/

    	//affichage 
    	return view('adresse.monAdresse')
        ->with('contacts', $contacts)
        ->with('results', $results);




    }


}
