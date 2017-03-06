<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Contact;
use App\Tag;

class publicContactController extends Controller
{

  public function show(Contact $contact)
  {

    if ($contact->geocode_status > 0)
    {
      // find nearby other contacts
      $km = 1;
      $distance = 0.01506 * $km;

      $contacts = \App\Contact::with('tags')
      ->where('longitude', '<', $contact->longitude + $distance / 2)
      ->where('longitude', '>', $contact->longitude - $distance / 2)
      ->where('latitude', '<', $contact->latitude + $distance / 2)
      ->where('latitude', '>', $contact->latitude - $distance / 2)
      ->where('id', '<>', $contact->id)
      ->limit(50)
      ->get();

      if ($contacts->count() == 0)
      {
        $contacts = false;
      }

    }
    else
    {
      $contacts = false;
    }

    return view('contact.show')
    ->with('title', $contact->name)
    ->with('contacts', $contacts)
    ->with('contact', $contact);
  }




}
