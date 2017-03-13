<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class MassDeleteController extends Controller
{

  // Shows a form where user can select a tag to delte all attached contacts to this particular tag
  public function massDeleteForm()
  {
    return view('admin.contact.massdelete')
    ->with('tags', \App\Tag::orderBy('name')->get());
  }


  public function massDelete(Request $request)
  {
    foreach ($request->get('tags') as $tag_id)
    {
      $tags[] = \App\Tag::findOrFail($tag_id);
    }

    $contacts_deleted = 0;

    foreach ($tags as $tag)
    {
      foreach ($tag->contacts as $contact)
      {
        $contact->delete();
        $contacts_deleted++;
      }
      flash()->info('Le tag ' . $tag->name . ' a bien été effacé.');
      $tag->delete();
    }

    flash()->info($contacts_deleted  . ' contacts effacés');

    return view('admin.contact.massdelete')
    ->with('tags', \App\Tag::orderBy('name')->get());

  }


}
