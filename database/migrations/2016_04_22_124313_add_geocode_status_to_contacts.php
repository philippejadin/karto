<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGeocodeStatusToContacts extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::table('contacts', function ($table) {
            $table->tinyInteger('geocode_status');
        });
    }

    /**
    * Reverse the migrations.
    *
    * @return void
    */
    public function down()
    {
        Schema::table('contacts', function ($table) {
            $table->dropColumn('geocode_status');
        });
    }
}
