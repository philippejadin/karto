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
        return view('contact.show')
        ->with('title', $contact->name)
        ->with('contact', $contact);
    }


}
