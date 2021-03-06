<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;
use Session;
use App\Http\Requests;
use Illuminate\Pagination\Paginator;
use Datatables;

class ContactController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index(Request $request)
  {


    $filter = \DataFilter::source(Contact::with('tags'));

    //simple like
    $filter->add('name','Nom', 'text');
    $filter->add('postal_code','Code postal', 'text');
    $filter->add('address','Adresse', 'text');
    //$filter->add('tags.name','Tags', 'tags'); // marche pas pour l'instant
    //$filter->text('src','Search')->scope('freesearch'); // marche pas pour l'instant


    $filter->submit('Recherche');
    $filter->reset('Reset');

    $grid = \DataGrid::source($filter);

    $grid->add('name','Nom', true); //field name, label, sortable
    $grid->add('postal_code','Code postal', true); //field name, label, sortable
    $grid->add('address','Adresse', true); //field name, label, sortable



    $grid->add('{{ implode(", ", $tags->lists("name")->all()) }}','Categories');

    //$grid->edit('admin/contact/edit', 'Edit','modify|delete'); //shortcut to link DataEdit actions


    $grid->add('edit','Edit')->cell( function( $value, $row) {
      return '<a href="/admin/contact/'. $row->id. '/edit">Edit</a>';
    });

    $grid->add('view','Voir')->cell( function( $value, $row) {
      return '<a href="/contact/'. $row->id. '">Voir</a>';
    });

    $grid->link('admin/contact/edit',"Add New", "TR");  //add button

    $grid->orderBy('name','asc'); //default orderby
    $grid->paginate(20); //pagination


    return view('admin.contact.grid')
    ->with('filter', $filter)
    ->with('grid', $grid);

  }


  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    $contact = new Contact();
    return view('admin.contact.create')
    ->with('contact', $contact);

  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request,  Contact $contact)
  {
    $contact->fill($request->all());

    if (!$request->has('tags') )
    {
      flash()->error('Contact non valide : il faut au minimum un tag secondaire (non principal) pour ce contact');
      return redirect()->back()
      ->withErrors($contact->getErrors())
      ->withInput();
    }


    // on tente de sauver une première fois le contact pour avoir son id (pour si jamais, lui attacher des tags)
    if (!$contact->save())
    {
      flash()->error('Contact non valide');
      return redirect()->back()
      ->withErrors($contact->getErrors())
      ->withInput();
    }

    if ($request->has('tags') )
    {
      $non_master_tags = \App\Tag::find($request->get('tags'))->where('master_tag' , 0);
      if ($non_master_tags->count() > 0)
      {
        $contact->tags()->sync($request->get('tags'));
      }
      else
      {
        flash()->error('Contact non valide : il faut au minimum un tag secondaire (non principal) pour ce contact');
        return redirect()->back()
        ->withErrors($contact->getErrors())
        ->withInput();
      }
    }
    else
    {
      flash()->error('Contact non valide : il faut au minimum un tag pour ce contact');
      return redirect()->back()
      ->withErrors($contact->getErrors())
      ->withInput();
    }


    if (! $contact->geocode())
    {
      flash()->warning('Adresse pas géocodée');
    }
    else
    {
      flash()->info('Adresse géocodée');
    }

    if ( ! $contact->save()) {
      flash()->error('Contact non valide');
      return redirect()->back()
      ->withErrors($contact->getErrors())
      ->withInput();
    }

    flash()->success('Contact bien ajouté');
    return redirect()->route('admin.contact.index');
  }

  /**
  * Display the specified resource.
  *
  * @param  Contact  $contact
  * @return \Illuminate\Http\Response
  */
  public function show(Contact $contact)
  {
    return view('contact.show',  compact('contact'));
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit(Contact $contact)
  {
    return view('admin.contact.edit',  compact('contact'));
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function update(Request $request, Contact $contact)
  {
    $contact->fill($request->all());


    if ($request->has('tags') )
    {
      $non_master_tags = \App\Tag::find($request->get('tags'))->where('master_tag' , 0);
      if ($non_master_tags->count() > 0)
      {
        $contact->tags()->sync($request->get('tags'));
      }
      else
      {
        flash()->error('Contact non valide : il faut au minimum un tag secondaire (non principal) pour ce contact');
        return redirect()->back()
        ->withErrors($contact->getErrors())
        ->withInput();
      }
    }
    else
    {
      flash()->error('Contact non valide : il faut au minimum un tag pour ce contact');
      return redirect()->back()
      ->withErrors($contact->getErrors())
      ->withInput();
    }


    if ($contact->geocode($force = true))
    {
      flash()->info('Adresse géocodée');
    }
    else
    {
      flash()->warning('Adresse pas géocodée');
    }




    if ( ! $contact->save()) {
      flash()->error('Contact non valide');
      return redirect()->back()
      ->withErrors($contact->getErrors())
      ->withInput();
    }

    flash()->success('Le contact a bien été enregistré');
    return redirect()->route('admin.contact.index');
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy(Contact $contact)
  {
    //$contact->tags()->detach();
    $contact->delete();
    flash()->success('Le contact a bien été effacé');
    return redirect()->route('admin.contact.index');
  }


  public function history(Contact $contact)
  {
    return view('admin.contact.history')->with('contact', $contact);
  }



}
