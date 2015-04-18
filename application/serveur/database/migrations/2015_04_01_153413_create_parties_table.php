<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartiesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('parties', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tour_courant')->unsigned()->default(0);
            $table->integer('nb_tours')->unsigned()->default(5);
            $table->integer('nb_joueurs_requis')->unsigned()->default(5);
            $table->integer('nb_joueurs_inscrits')->unsigned()->default(0);
            $table->enum('phase', ['negociation', 'combat'])->default('combat');
            $table->enum('statut', ['attente_joueurs', 'en_jeu', 'fin'])->default('attente_joueurs');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('parties');
    }
}
