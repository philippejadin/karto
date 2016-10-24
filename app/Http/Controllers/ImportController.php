<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Excel;

class ImportController extends Controller
{
    public function importForm()
    {
        return view('admin.import');
    }



    public function import(REQUEST $request)
    {

        if($request->hasFile('import_file'))
        {
            $path = $request->file('import_file')->getRealPath();

            $data = Excel::load($path, function($reader) {
            })->get();

            $lines = $data->first(); // get first sheet from our file. Oh yes we won't support multiple sheets

            if(!empty($lines) && $lines->count())
            {
                foreach ($lines as $line)
                {
                    if (isset($line['address']) && isset($line['name']) && isset($line['postal_code']))
                    {

                        $contact = \App\Contact::firstOrCreate(['address' => $line['address'], 'postal_code' => $line['postal_code'], 'name' => $line['name'] ] );
                        $contact->fill($line->toArray());

                        if ($contact->save())
                        {
                            // handle tags
                            if (isset($line['tags']))
                            {
                                $tags = explode(',', $line['tags']);

                                foreach ($tags as $tag)
                                {
                                    trim($tag);
                                    $the_tag = \App\Tag::firstOrCreate(['name'=> $tag]);

                                    if (!$contact->tags->contains($the_tag->id))
                                    {
                                        $contact->tags()->save($the_tag);
                                    }
                                }

                            }

                            flash()->success('Contact ' . $contact->name . ' correctement importe');
                        }
                        else
                        {
                            flash()->error('Contact ' . $contact->name . ' pas importé');
                        }
                    }
                    else
                    {
                        flash()->error('Ligne vide');
                    }
                } // endforeach lines

            }// end import / end of file
        }
        else // pas de fichier
        {
            die('Choisissez un fichier');
        }

        return view('admin.import');

    }

}
