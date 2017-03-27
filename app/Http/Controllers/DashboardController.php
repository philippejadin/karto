<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use App\Http\Controllers\Controller;
use Geocoder\Laravel\Facades\Geocoder;
use App\Contact;


/**
* Class DashboardController
* @package App\Http\Controllers
*
* Page d'accueil publique qui affiche une boite de recherche, une carte et les résultats
*
*/
class DashboardController extends Controller
{

  public function index(Request $request)
  {

    // liste des tags pour recherche

    $master_tags = \App\Tag::where('master_tag', 1)->orderBy('name')->lists('name', 'id');

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


      // gestion du tag limitant la recherche
      if ($request->get('tag'))
      {
        $limit_by_tag = \App\Tag::findOrFail($request->get('tag'));
      }
      else
      {
        $limit_by_tag = false;
      }


      //la géocoder

      try
      {
        $result = Geocoder::geocode($keyword . ' ,' . env('DEFAULT_COUNTRY', 'Belgique'))->get()->first();
        $results['latitude'] = $result->getLatitude();
        $results['longitude'] = $result->getLongitude();
      }
      catch (\Exception $e)
      {
        flash()->warning("Merci de réessayer avec une adresse standard comprenant une rue, un numéro, et un code postal. ("  . $e->getMessage() . ")", "Votre adresse n'a pas été localisée ");
        return view('dashboard.index')
        ->with('keyword', $request->keyword)
        ->with('searched', false)
        ->with('master_tags', $master_tags)
        ->with('tag', $request->get('tag'))
        ->with('km', $km);
      }








      $latitude = 0.01506 * $km;
      $longitude = 0.01506 * $km * 2; // experimentally determined


      if ($limit_by_tag)
      {
        // compter le nombre d'organismes trouvés
        $contact_count = $limit_by_tag->contacts()->where('longitude', '<', $result->getLongitude() + $longitude / 2)
        ->where('longitude', '>', $result->getLongitude() - $longitude / 2)
        ->where('latitude', '<', $result->getLatitude() + $latitude / 2)
        ->where('latitude', '>', $result->getLatitude() - $latitude / 2)
        ->count();
      }
      else
      {
        // compter le nombre d'organismes trouvés
        $contact_count = \App\Contact::where('longitude', '<', $result->getLongitude() + $longitude / 2)
        ->where('longitude', '>', $result->getLongitude() - $longitude / 2)
        ->where('latitude', '<', $result->getLatitude() + $latitude / 2)
        ->where('latitude', '>', $result->getLatitude() - $latitude / 2)
        ->count();
      }

      $max_results = 500; // TODO configurable


      if ($contact_count > ($max_results))
      {
        $ratio = $contact_count / $max_results;
        $km = $km / $ratio;
        flash()->info("Il y a trop de résultats (" . $contact_count . " résultats trouvés) dans le périmètre choisi, nous avons automatiquement réduit le périmètre de recherche (" . $km . "km)");
      }



      $latitude = 0.01506 * $km;
      $longitude = 0.01506 * $km * 2; // experimentally determined

      if ($limit_by_tag)
      {
        $contacts = $limit_by_tag->contacts()->with('publicTags')
        ->where('longitude', '<', $result->getLongitude() + $longitude / 2)
        ->where('longitude', '>', $result->getLongitude() - $longitude / 2)
        ->where('latitude', '<', $result->getLatitude() + $latitude / 2)
        ->where('latitude', '>', $result->getLatitude() - $latitude / 2)
        ->get();
      }
      else
      {
        $contacts = \App\Contact::with('publicTags')
        ->where('longitude', '<', $result->getLongitude() + $longitude / 2)
        ->where('longitude', '>', $result->getLongitude() - $longitude / 2)
        ->where('latitude', '<', $result->getLatitude() + $latitude / 2)
        ->where('latitude', '>', $result->getLatitude() - $latitude / 2)
        ->get();
      }


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
        foreach ($contact->publicTags as $tag)
        {
          if ($tag->master_tag == 1 && $tag->public == 1)
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



      if (count($contacts) == 0)
      {
        flash()->info('Aucun résultats trouvés, veuillez élargir votre recherche');
      }

      return view('dashboard.index')
      ->with('tags', $tags)
      ->with('other_contacts', $other_contacts)
      ->with('results', $results)
      ->with('keyword', $keyword)
      ->with('km', $km)
      ->with('master_tags', $master_tags)
      ->with('tag', $request->get('tag'))
      ->with('searched', true);


    }
    /*s'il n'y a pas de keyword, ne rien afficher*/
    else
    {
      //l'afficher
      return view('dashboard.index')
      ->with('keyword', null)
      ->with('km', 0)
      ->with('home', true)
      ->with('master_tags', $master_tags)
      ->with('tag', $request->get('tag'))
      ->with('searched', false);
    }
  }
}
