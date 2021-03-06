<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_conversation')->unsigned()->references('id')->on('conversations')->onDelete('cascade');
            $table->integer('id_joueur')->unsigned()->references('id')->on('joueurs')->onDelete('cascade');
            $table->string('texte');
            $table->timestamps();

            $table->index('id_conversation');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('messages');
    }
}
