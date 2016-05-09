<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use App\Http\Controllers\Controller;
use Toin0u\Geocoder\Facade\Geocoder;
use App\Contact;


/**
 * Class monAdresseController
 * @package App\Http\Controllers
 * 
 * Page d'accueil publique qui affiche une boite de recherche, une carte et les résultats
 * 
 */
class monAdresseController extends Controller
{
    //taper son addresse
    public function monAdresse(Request $request)
    {   
        /*Si la requête a un keyword afficher la recherche*/
        if ($request->has('keyword'))
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
            

            
/*            $results['longitude'] = "4.367414";
            $results['latitude'] = "50.837530";*/



            //variable de calcul de distance
            if ($request->has('km'))
                { 
                    $km = $request->get('km');
                }
                else
                {
                    $km = 0;
                }
                
            $distance = 0.01506 * $km;

        	//faire une recherche de proximité
            $contacts = \App\Contact::where('longitude', '<', $results['longitude'] + $distance / 2)
                    ->where('longitude', '>', $results['longitude'] - $distance / 2)
                    ->where('latitude', '<', $results['latitude'] + $distance / 2)
                    ->where('latitude', '>', $results['latitude'] - $distance / 2)
                    ->limit(250)
                    ->get();

            if (count($contacts)>300) {
                return view('adresse.monAdresse')
                    ->with('contacts', $contacts)
                    ->with('results', $results)
                    ->with('keyword', $keyword)
                    ->with('km', $km)
                    ->with('searched', true);
            }
            else{
                //l'afficher
                return view('adresse.monAdresse')
                    ->with('contacts', $contacts)
                    ->with('results', $results)
                    ->with('keyword', $keyword)
                    ->with('km', $km)
                    ->with('searched', true); 
            }   

            


        }
        /*s'il n'y a pas de keyword, ne rien afficher*/
        else
        {
            //l'afficher
            return view('adresse.monAdresse')
            ->with('keyword', null)
            ->with('km', 0)
            ->with('searched', false);
        }
    }
}
