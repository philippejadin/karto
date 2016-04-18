<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Excel;

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

        Excel::load(storage_path('app/import/test.xls'), function ($reader) {

            $reader->each(function($sheet) {
                foreach ($sheet->toArray() as $row) {
                    $contact = \App\Contact::firstOrCreate($row);

                    $this->info('Contact ' . $contact->name . ' correctement importe');
                }
            });
        });


    }
}
