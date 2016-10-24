<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Excel;
use Storage;

class ImportContacts extends Command
{

    public $contact_imported = 0;
    public $contact_not_imported = 0;

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


        $this->contact_imported = 0;
        $this->contact_not_imported = 0;

        $data = Excel::load(storage_path('app/' . $file), function($reader) {
        })->get();

        $lines = $data->first(); // get first sheet from our file. Oh yes we won't support multiple sheets

        if(!empty($lines) && $lines->count())
        {
            $bar = $this->output->createProgressBar($lines->count());

            foreach ($lines->toArray() as $row)
            {


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

                        $this->info('Contact ' . $contact->name . ' correctement importé');
                        $this->contact_imported ++;
                    }
                    else
                    {
                        $this->error('Contact ' . $contact->name . ' pas importé');
                        $this->contact_not_imported ++;
                    }
                }
                else
                {
                    $this->contact_not_imported ++;
                    $this->error('Ligne vide ou incomplète détectée');
                }

                $bar->advance();
            }

            $bar->finish();
        }


        $this->line('--------------------------------');
        $this->info($this->contact_imported . ' contacts importés avec succès');
        $this->error($this->contact_not_imported . ' contacts pas importés (voir messages ci-dessus)');



    }

}
