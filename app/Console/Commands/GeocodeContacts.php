<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GeocodeContacts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'karto:geocode';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Geocode les contacts pas encore géocodés';

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
        // trouver 5 contacts sans longitude ou latitude
        // les geocoder et le sauver (cfr. le modèle contact)
        $contacts = \App\Contact::whereNull('longitude')->orWhereNull('latitude')->take(5)->get();

        foreach ($contacts as $contact)
        {
            $contact->geocode();
            $contact->save();
        }

    }
}
