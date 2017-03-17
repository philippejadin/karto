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
        $contacts = $tag->contacts()->orderBy('name')->paginate(25);
        return view('tag.show')
        ->with('contacts', $contacts)
        ->with('tag', $tag);
    }

    public function overview()
    {
      $tags = \App\Tag::orderBy('master_tag', 'desc')->orderBy('name')->where('public', 1)->get();

      return view('tag.index')
      ->with('tags', $tags);
    }

}
