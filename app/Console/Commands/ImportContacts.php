<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Excel;
use Storage;

class ImportContacts extends Command
{
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
        Excel::load(storage_path('app/' . $file), function ($reader) {
            $reader->each(function($sheet) {
                foreach ($sheet->toArray() as $row) {
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
                                $contact->tags()->attach(\App\Tag::firstOrCreate(['name'=> $tag])->id);
                            }
                        }

                        $this->info('Contact ' . $contact->name . ' correctement importe');
                    }
                    else
                    {
                        $this->error('Contact ' . $contact->name . ' pas importé');
                    }

                }
            });
        });


    }
}
