<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateContactsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts',function(Blueprint $table){
            $table->increments("id");
            $table->string("name");
            $table->string("description");
            $table->string("address");
            $table->string("postal_code");
            $table->string("locality");
            $table->string("country");
            $table->string("phone");
            $table->string("phone2");
            $table->string("website");
            $table->string("email");
            $table->tinyInteger("public")->default(0);
            $table->float('latitude', 10, 7);
            $table->float('longitude', 10, 7);
            $table->string("uuid");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('contacts');
    }

}