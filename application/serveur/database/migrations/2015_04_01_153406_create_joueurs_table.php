<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJoueursTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('joueurs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_partie')->unsigned()->references('id')->on('parties')->onDelete('cascade');
            $table->string('pseudo');
            $table->string('pays');
            $table->timestamps();

            $table->index('id_partie');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('joueurs');
    }
}
