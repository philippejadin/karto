<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use DB;

class ReportController extends Controller
{
  /**
  * List contacts who are clearly duplicates
  */
  public function duplicates()
  {
    /*
    SELECT group_concat( id ) , group_concat( name )
    FROM contacts
    GROUP BY longitude, latitude, soundex( name )
    HAVING count( 'longitude, latitude, soundex(name)' ) >1
    LIMIT 0 , 30
    */
    $duplicates_raw = DB::select(DB::raw('SELECT group_concat( id ) as ids , group_concat( name ) as names
    FROM contacts
    where deleted_at is null
    and longitude <> 0
    GROUP BY longitude, latitude, soundex( name )
    HAVING count( \'longitude, latitude, soundex(name)\' ) >1'));

    $duplicates = array();
    foreach ($duplicates_raw as $duplicate)
    {
      $ids = explode(',', $duplicate->ids);
      $names = explode(',', $duplicate->names);
      $dup = array();

      for ($i = 0; $i < count($ids); $i++)
      {
        $dup[$ids[$i]] = $names[$i];
      }
      $duplicates[] = $dup;


    }
    //dd($duplicates);

    return view('admin.contact.duplicates')->with('duplicates', $duplicates);
  }


  /**
  * Contacts sans tag
  */
  public function untagged()
  {

    // requête des contacts sans tags qui fonctionne:
    // SELECT * from contacts where (select count(*) from contact_tag where contact_tag.contact_id = contacts.id) <1

    // pas de tags attachés :
    $contacts = \App\Contact::has('tags', '<', 1)->paginate(40);

    return view('admin.contact.index')->with('contacts', $contacts)->with('title', 'Liste des contacts sans tags');
  }

  /**
  * Contacts avec uniquement un master tag
  */
  public function withOnlyMasterTag()
  {

    // contacts avec uniquement un master tag
    $contacts = \App\Contact::whereHas('tags', function ($q)
    {
      $q->where('master_tag', '=', 1);
    })
    ->whereDoesntHave('tags', function ($q)
    {
      $q->where('master_tag', '=', 0);
    })
    ->paginate(40);


    return view('admin.contact.index')->with('contacts', $contacts)->with('title', 'Liste des contacts avec uniquement un tag principal');
  }



  /**
  * Affiche les contacts non géocodés
  */
  public function geocoded(Request $request)
  {
    $contacts = \App\Contact::where('geocode_status', '<' , 0)->with('tags')->paginate(40);
    return view('admin.contact.index')->with('contacts', $contacts)->with('title', 'Liste des contacts en erreur de géocodage');
  }



}
