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
        // tri recherche session
        // sinon tri par défaut sur le nom par ordre alphabétique
        if ($request->session()->get('sort'))
        {
            $sort = $request->session()->get('sort');
        }
        else
        {
            $sort = 'updated_at';
        }

        if ($request->session()->get('order'))
        {
            $order = $request->session()->get('order');
        }
        else
        {
            $order = 'desc';
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



        $contacts=Contact::orderBy($sort, $order)->paginate(40);

        return view('admin.contact.index')
        ->with('contacts', $contacts);
    }


    /**
    * Datables attempt n°1
    */

    public function datatable()
    {
        return view('admin.contact.datatablesindex');
    }

    /**
    * Process datatables ajax request.
    *
    * @return \Illuminate\Http\JsonResponse
    */
    public function datatableData()
    {
        return Datatables::of(Contact::query())
        ->addColumn('action', function ($contact) {
            return '<a href="'. action('ContactController@edit', $contact->id) . '" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
        })
        ->make(true);


    }


    /**
    * Affiche les contacts non géocodés
    */
    public function indexGeocoded(Request $request)
    {
        $contacts=Contact::where('geocode_status', '<' , 0)->paginate(40);

        return view('admin.contact.index')
        ->with('contacts', $contacts);
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

        // on tente de sauver une première fois le contact pour avoir son id (pour si jamais, lui attacher des tags)
        if (!$contact->save())
        {
            flash()->error('Contact non valide');
            return redirect()->back()
            ->withErrors($contact->getErrors())
            ->withInput();
        }

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
        $contact->tags()->detach();
        $contact->delete();
        flash()->success('Le contact a bien été effacé');
        return redirect()->back();
    }


    public function history(Contact $contact)
    {
        return view('admin.contact.history')->with('contact', $contact);
    }



}
