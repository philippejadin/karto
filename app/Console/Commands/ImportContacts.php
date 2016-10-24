<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Excel;
use Storage;

class ImportContacts extends Command
{

    public $contact_imported = 0;

    /**
    * The name and signature of the console command.
    *
    * @var string
    */
    protected $signature = 'karto:import';

    /**
    * The console command description.
    *
    * @var string
    */
    protected $description = 'Importe les contacts depuis le dossier storage/app/import. Mettre d\'abord le fichier à importer dans ce dossier et puis lancer la commande';

    /**
    * Create a new command instance.
    *
    * @return void
    */
    public function __construct()
    {
        parent::__construct();
    }

    /**
    * Execute the console command.
    *
    * @return mixed
    */
    public function handle()
    {
        $file = $this->choice('Quel fichier importer?', Storage::files('/import/'));

        // TODO validation colonnes dans fichier excell
        $this->contact_imported = 0;

        Excel::load(storage_path('app/' . $file), function ($reader)
        {
            //$reader->dump();
            $reader->each(function($sheet)
            {
                foreach ($sheet->toArray() as $row)
                {

                    //dd ($row);

                    //$this->info('Contact ' . $row['address'] . ' analysé');

                    if (isset($row['address']) && isset($row['name']) && isset($row['postal_code']))
                    {

                        $contact = \App\Contact::firstOrCreate(['address' => $row['address'], 'postal_code' => $row['postal_code'], 'name' => $row['name'] ] );
                        $contact->fill($row);

                        if ($contact->save())
                        {
                            // handle tags
                            if (isset($row['tags']))
                            {
                                $tags = explode(',', $row['tags']);

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

                            $this->info('Contact ' . $contact->name . ' correctement importe');
                            $this->contact_imported ++;
                            $this->info($this->contact_imported . ' contacts importés avec succès');
                        }
                        else
                        {
                            $this->error('Contact ' . $contact->name . ' pas importé');
                        }
                    }
                    else
                    {
                        $this->error('Ligne ' . $row . ' pas importé');
                    }

                }
            });
        });

        $this->info($this->contact_imported . ' contacts importés avec succès');


    }
}
