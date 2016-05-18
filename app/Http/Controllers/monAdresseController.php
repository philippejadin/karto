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

        /*
        flash()->success('You successfully read this important alert message.')
        ->info('This alert needs your attention, but it\'s not super important.')
        ->warning('Better check yourself, you\'re not looking too good.')
        ->error('Change a few things up and try submitting again.')
        ->overlay('One fine body...');

        dd($request);
        */

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

            //la géocoder
            try
            {
                $results = Geocoder::geocode($keyword);
            }
            catch (\Exception $e)
            {
                flash()->warning("Merci de réessayer avec une adresse standard comprenant une rue, un numéro, et un code postal", "Votre adresse n'a pas été localisée");
                return view('adresse.monAdresse')
                ->with('keyword', $request->keyword)
                ->with('searched', false)
                ->with('km', $km);
            }




            $distance = 0.01506 * $km;

            // compter le nombre d'orgnaismes trouvés
            $contact_count = \App\Contact::where('longitude', '<', $results['longitude'] + $distance / 2)
            ->where('longitude', '>', $results['longitude'] - $distance / 2)
            ->where('latitude', '<', $results['latitude'] + $distance / 2)
            ->where('latitude', '>', $results['latitude'] - $distance / 2)
            ->count();


            $max_results = 300; // TODO configurabel


            if ($contact_count > ($max_results))
            {
                $ratio = $contact_count / $max_results;
                $km = $km / $ratio;
                flash()->info("Il y a trop de résultats (" . $contact_count . " résultats trouvés) dans le périmètre choisi, nous avons automatiquement réduit le périmètre de recherche (" . $km . "km)");
            }




            $distance = 0.01506 * $km;

            // Dans tous les cas on affiche

            $tags = \App\Tag::where('master_tag', 1)
            ->with(['contacts' => function ($query) use ($results, $distance) {
                $query->where('longitude', '<', $results['longitude'] + $distance / 2)
                ->where('longitude', '>', $results['longitude'] - $distance / 2)
                ->where('latitude', '<', $results['latitude'] + $distance / 2)
                ->where('latitude', '>', $results['latitude'] - $distance / 2)
                ->with('tags');

            }])->get();

            //dd($tags);

            /*
            $tags = \App\Tag::where('master_tag', 1)->get();

            foreach ($tags as $tag)
            {
                $tag->load('contacts')->where('longitude', '<', $results['longitude'] + $distance / 2)
                ->where('longitude', '>', $results['longitude'] - $distance / 2)
                ->where('latitude', '<', $results['latitude'] + $distance / 2)
                ->where('latitude', '>', $results['latitude'] - $distance / 2);
            }
            */



            // Dans tous les cas on affiche

            /*
            $contacts = \App\Contact::with('tags', 'masterTags')
            ->where('longitude', '<', $results['longitude'] + $distance / 2)
            ->where('longitude', '>', $results['longitude'] - $distance / 2)
            ->where('latitude', '<', $results['latitude'] + $distance / 2)
            ->where('latitude', '>', $results['latitude'] - $distance / 2)
            ->get()->groupBy('masterTag');


            dd($contacts);
            */


            //flash()->info(count($contacts) . " résultats trouvés");

            return view('adresse.monAdresse')
            ->with('tags', $tags)
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
