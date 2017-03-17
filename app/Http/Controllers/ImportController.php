<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Excel;
use Carbon\Carbon;

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
      $filename = $request->file('import_file')->getClientOriginalName();

      $data = Excel::load($path, function($reader) {
      })->get();

      $lines = $data->first(); // get first sheet from our file. Oh yes we won't support multiple sheets

      $import_success = 0;

      if(!empty($lines) && $lines->count())
      {


        // create a tag for the import
        $time = Carbon::now();
        $timetag = \App\Tag::firstOrCreate(['name'=> 'Import ' . $time->format('Y-m-d H:i:s') . ' (' . $filename . ')']);

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
                  $the_tag = \App\Tag::firstOrCreate(['name'=> trim($tag)]);

                  if (!$contact->tags->contains($the_tag->id))
                  {
                    $contact->tags()->save($the_tag);
                  }
                }

              }

              // append the time tag to theimported contact
              $contact->tags()->save($timetag);

              // flash()->success('Contact ' . $contact->name . ' correctement importe');
              $import_success++;
            }
            else
            {
              flash()->error('Contact ' . $contact->name . ' pas importé');
            }
          }
          else
          {
            flash()->error('Ligne vide ou ne contenant pas au minimum les colonnes address, name et postal_code');
          }
        } // endforeach lines

      }// end import / end of file
    }
    else // pas de fichier
    {
      die('Veuillez choisir un fichier à importer depuis votre ordinateur');
    }

    flash()->success($import_success . ' contacts importés correctement');

    return view('admin.import');

  }

}
