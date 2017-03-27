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
  protected $signature = 'karto:geocode {size=500} {--retry} {--force}';

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

    if ($this->option('retry'))
    {
      $contacts = \App\Contact::where('geocode_status', '<', 0)->take($this->argument('size'))->get();
    }
    elseif ($this->option('force'))
    {
      $contacts = \App\Contact::take($this->argument('size'))->get();
    }
    else
    {
      $contacts = \App\Contact::where('geocode_status', '=', 0)->take($this->argument('size'))->get();
    }



    foreach ($contacts as $contact)
    {
      if ($contact->geocode(['force' => true]))
      {
        $contact->forceSave();
        $this->info('Contact ' . $contact->name . ' correctement geolocalise');
      }
      else {
        $contact->save(['force' => true]);
        $this->error('Contact ' . $contact->name . ' pas geolocalise, geocode status : ' . $contact->geocode_status . ' / Message : ' . $contact->geocode_message);
      }
      //sleep(1);
    }
  }


}
