<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commandes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('livreur_id')->unsigned()->nullable(true);
            $table->foreign('livreur_id')->references('id')->on('livreurs');
            $table->string('produit')->nullable(true);
            $table->integer('quantite')->nullable(true);
            $table->string('prix')->nullable(true);
            $table->string('command_express')->nullable(true);
            $table->string('nom_client')->nullable(true);
            $table->string('telephone')->nullable(true);
            $table->string('wilaya')->nullable(true);
            $table->string('commune')->nullable(true);
            $table->string('state')->nullable(true);
            $table->string('note')->nullable(true);
            $table->date('date_livraison')->nullable(true);        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commandes');
    }
}
