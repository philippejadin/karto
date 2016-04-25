<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;
use Session;
use App\Http\Requests;
use Illuminate\Pagination\Paginator;

class ContactController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {

        // tri recherche session
        // sinon tri par défaut sur le nom par ordre alphabétique
        if ($request->session()->get('sort'))
        {
            $sort = $request->session()->get('sort');
        }
        else
        {
            $sort = 'name';
        }

        if ($request->session()->get('order'))
        {
            $order = $request->session()->get('order');
        }
        else
        {
            $order = 'asc';
        }



        //... sauf si l'utilisateur demande autre chose :
        if ($request->input('sort'))
        {
            $sort = $request->input('sort');
            $request->session()->set('sort', $sort);
        }


        if ($request->input('order'))
        {
            $order = $request->input('order');
            $request->session()->set('order', $order);
        }



        /******* TODO voir si c'est une bonne idée ce stockage de la page en cours dans la session : **********/

        // si l'utilisateur est sur une page (autre que 0) o la stocke dans sa session
        if ($request->input('page'))
        {
            $request->session()->set('page', $request->input('page'));
        }


        // si on a un numéro de page dans la session, on va à cette page
        if ($request->session()->get('page'))
        {

            $currentPage = $request->session()->get('page');
            Paginator::currentPageResolver(function() use ($currentPage) {
                return $currentPage;
            });
        }

        /**************************************/

         $contacts=Contact::orderBy($sort, $order)->paginate(20);


        return view('admin.contact.index', compact('contacts'));
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
        $contact->save();

        if ($request->has('tags') ) {
            $contact->tags()->sync($request->get('tags'));
        }

        if (! $contact->geocode())
        {
            flash()->info('Adresse pas géocodée');
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
        return view('admin.contact.show',  compact('contact'));
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

        if ($request->has('tags') ) {
            $contact->tags()->sync($request->get('tags'));
        }

        if (! $contact->geocode($force = true))
        {
            flash()->info('Adresse pas géocodée');
        }


        if ( ! $contact->save()) {
            flash()->error('Contact non valide');
            return redirect()->back()
            ->withErrors($contact->getErrors())
            ->withInput();
        }



            flash()->success('L\'organisme a bien été enregistré');
        return redirect()->route('admin.contact.index');
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        return redirect()->back();
    }




}
