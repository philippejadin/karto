<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use DB;

class DuplicateController extends Controller
{
  public function index()
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
}
