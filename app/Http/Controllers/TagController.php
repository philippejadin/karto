<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Contact;
use Illuminate\Http\Request;

use App\Http\Requests;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::orderBy('name')->paginate(20);

        return view('admin.tag.index')
        ->with('tags', $tags);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tag.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Tag $tag)
    {
        $tag->fill($request->all());

        if ($request->has('master_tag'))
        {
            $tag->master_tag = 1;
        }
        else
        {
         $tag->master_tag = 0;
     }

     if ( ! $tag->save())
     {
        return redirect()->back()
        ->withErrors($tag->getErrors())
        ->withInput();
    }

    flash()->success('Tag bien ajouté');

    return redirect()->route('admin.tag.index');
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        return view('admin.tag.show')
        ->with('tag', $tag);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        return view('admin.tag.edit')
        ->with('tag', $tag);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        $tag->fill($request->all());


        if ($request->has('master_tag'))
        {
            $tag->master_tag = 1;
        }
        else
        {
         $tag->master_tag = 0;
     }

     if ( ! $tag->save()) 
     {
        return redirect()->back()
        ->withErrors($tag->getErrors())
        ->withInput();
    }

    return redirect()->route('admin.tag.index')
    ->withSuccess("Your post was saved successfully.");

}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();
        return redirect()->back();
    }

    public function changeForm()
    {
        return view('admin.tag.change')
        ->with('tags', \App\Tag::all());
    }

    public function change(Request $request)
    {
        $tag = \App\Tag::findOrFail($request->get('tag'));

        if ($request->get('tag_to_add') <> 0) 
        {
            $tag_to_add = \App\Tag::findOrFail($request->get('tag_to_add'));

            foreach ($tag->contacts as $contact) 
            {
                $contact->tags()->attach($tag_to_add->id);
            }

            flash()->success('Le tag a bien été changé');         
        }

        if ($request->get('tag_to_remove') <> 0)
        {
            $tag_to_remove = \App\Tag::findOrFail($request->get('tag_to_remove'));

            foreach ($tag->contacts as $contact) 
            {
                $contact->tags()->detach($tag_to_remove->id);
            }

            flash()->success('Le tag a bien été changé');
              
        }

        return redirect()->action('TagController@index');

    }
}
