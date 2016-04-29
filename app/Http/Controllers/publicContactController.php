<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Contact;
use App\Tag;

class publicContactController extends Controller
{
   
    public function detail(Contact $contact)
    {
        return view('contact.detail')
        ->with('contact', $contact);
    }
    

}
