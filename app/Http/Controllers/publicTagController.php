<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Contact;
use App\Tag;

class publicTagController extends Controller
{

    public function show(Tag $tag)
    {
        $contacts = $tag->contacts()->paginate(15);
        return view('tag.show')
        ->with('contacts', $contacts)
        ->with('tag', $tag);
    }


}
