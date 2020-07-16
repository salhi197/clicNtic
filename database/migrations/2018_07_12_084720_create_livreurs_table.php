<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLivreursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('livreurs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable(true);
            $table->string('prenom')->nullable(true);
            $table->string('email')->unique()->nullable(true);
            $table->string('password')->nullable(true);
            $table->boolean('is_editor')->default(false)->nullable(true);
            $table->string('adress')->nullable(true);
            $table->string('telephone')->nullable(true);

            $table->date('birth')->nullable(true);
            $table->rememberToken();
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
        Schema::dropIfExists('livreurs');
    }
}