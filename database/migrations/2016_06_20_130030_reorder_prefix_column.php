<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ReorderPrefixColumn extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {

        Schema::table('contacts', function(Blueprint $table)
        {
            $table->dropColumn("prefix");
        });


        Schema::table('contacts', function(Blueprint $table)
        {
            $table->text('prefix')->after("id");
        });
    }

    /**
    * Reverse the migrations.
    *
    * @return void
    */
    public function down()
    {
        //
    }
}
