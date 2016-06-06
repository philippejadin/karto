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

            // Définir les valeurs par défaut
            if ($request->has('km'))
            {
                $km = $request->get('km');
            }
            else
            {
                $km = 1;
            }


            //récupérer l'adresse rentrée par l'utilisateur
            $keyword = $request->get('keyword');

            if ($keyword == 'debug')
            {
              $results['latitude'] = 50.850340;
              $results['longitude'] = 4.351710;
            }
            else
            {  

              //la géocoder

              try
              {
                  $results = Geocoder::geocode($keyword);
              }
              catch (\Exception $e)
              {
                  flash()->warning("Merci de réessayer avec une adresse standard comprenant une rue, un numéro, et un code postal. ("  . $e->getMessage() . ")", "Votre adresse n'a pas été localisée ");
                  return view('adresse.monAdresse')
                  ->with('keyword', $request->keyword)
                  ->with('searched', false)
                  ->with('km', $km);
              }

            }





            $distance = 0.01506 * $km;

            // compter le nombre d'organismes trouvés
            $contact_count = \App\Contact::where('longitude', '<', $results['longitude'] + $distance / 2)
            ->where('longitude', '>', $results['longitude'] - $distance / 2)
            ->where('latitude', '<', $results['latitude'] + $distance / 2)
            ->where('latitude', '>', $results['latitude'] - $distance / 2)
            ->count();


            $max_results = 300; // TODO configurable


            if ($contact_count > ($max_results))
            {
                $ratio = $contact_count / $max_results;
                $km = $km / $ratio;
                flash()->info("Il y a trop de résultats (" . $contact_count . " résultats trouvés) dans le périmètre choisi, nous avons automatiquement réduit le périmètre de recherche (" . $km . "km)");
            }



            $distance = 0.01506 * $km;

            $contacts = \App\Contact::with('tags')
            ->where('longitude', '<', $results['longitude'] + $distance / 2)
            ->where('longitude', '>', $results['longitude'] - $distance / 2)
            ->where('latitude', '<', $results['latitude'] + $distance / 2)
            ->where('latitude', '>', $results['latitude'] - $distance / 2)
            ->get();


            $tags = [];
            $other_contacts = [];

            /*
            Trier par tags
            Avec cette routine, la vue reçoit un beau tableau à deux dimmensions $tags

            qui contient chaque master tag

            $tags[1]['tag'] -> objet master tag
            $tags[1]['contacts'] -> liste des contacts associés
            */
            foreach ($contacts as $contact)
            {
                $has_master_tag = false;
                foreach ($contact->tags as $tag)
                {
                    if ($tag->master_tag == 1)
                    {
                        $tags[$tag->id]['tag'] = $tag;
                        $tags[$tag->id]['contacts'][] = $contact;
                        $has_master_tag = true;
                    }
                }
                // si le contact n'a pas de master tag, on le met dans un autre tableau appellé $other_contacts pour le mettre en fin de liste, rubrique "autres"
                if (!$has_master_tag)
                {
                    $other_contacts[] = $contact;
                }

            }




            //flash()->info(count($contacts) . " résultats trouvés");

            return view('adresse.monAdresse')
            ->with('tags', $tags)
            ->with('other_contacts', $other_contacts)
            ->with('results', $results)
            ->with('keyword', $keyword)
            ->with('km', $km)
            ->with('searched', true);


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
