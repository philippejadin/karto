<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactTable extends Migration
{
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
