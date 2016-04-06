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

        /*
        Ici ajouter les champs nécessaires pour la base de donnée, à réfléchir

        proposition (en anglais):


        name : nom de l'organisme
        description : description (texte long)
        address : adresse, rue et numéro
        postal_code : code postal
        locality : commune
        country : pays (défault belgium)
        phone : téléphone
        phone2 : téléphone 2 ou fax
        website : site web
        email : email
        public : true / false
        latitude
        longitude
        uuid
        */


        Model::unguard();
        Schema::create('contacts',function(Blueprint $table){
            $table->increments("id");
            $table->text("name")->nullable();
            $table->text("description")->nullable();
            $table->string("address")->nullable();
            $table->string("postal_code")->nullable();
            $table->string("locality")->nullable();
            $table->string("country")->nullable();
            $table->string("phone")->nullable();
            $table->string("phone2")->nullable();
            $table->string("website")->nullable();
            $table->string("email")->nullable();
            $table->tinyInteger("public")->default(0)->nullable();
            $table->string("latitude")->nullable();
            $table->string("longitude")->nullable();
            $table->string("uuid")->nullable();
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
