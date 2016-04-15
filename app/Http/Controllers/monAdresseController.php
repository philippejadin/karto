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
    	$results = Geocoder::geocode($keyword); 

        //afficher l'array de l'objet $results
        /*var_dump($results);*/
        
 
    	//faire une recherche de proximité
        $prox = DB::where('longitude', '>', $results['longitude'] + ['0.1506'])
                        ->orWhere('longitude', '<', $results['longitude'] - ['0.1506'])
                        ->orWhere('latitude', '>', $results['latitude'] + ['0.1506'])
                        ->orWhere('latitude', '<', $results['latitude'] - ['0.1506'])
                        ->get();


    	//l'afficher
    	return view('adresse.monAdresse',$prox);
    }


}
