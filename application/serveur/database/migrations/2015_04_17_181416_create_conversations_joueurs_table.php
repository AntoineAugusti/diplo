<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConversationsJoueursTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('conversations_joueurs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_conversation')->unsigned()->references('id')->on('conversations')->onDelete('cascade');
            $table->integer('id_joueur')->unsigned()->references('id')->on('joueurs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('conversations_joueurs');
    }
}
