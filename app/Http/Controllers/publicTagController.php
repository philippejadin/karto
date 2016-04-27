<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Tag;
use App\Http\Requests;
use App\Contact;

class publicTagController extends Controller
{
    public function afficherContactsParTag(){
	   	$tag=$this->contacts()
	    		   ->get();	

		return view('adresse.monAdresse')
			->with('tag', $tag)
			->with('contact', $contact);
    }
}
