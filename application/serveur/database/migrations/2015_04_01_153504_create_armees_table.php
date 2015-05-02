<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArmeesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('armees', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_joueur')->unsigned()->references('id')->on('joueurs')->onDelete('cascade');
            $table->integer('id_case')
                ->nullable()
                ->default(null)
                ->unsigned()
                ->references('id')
                ->on('cases')
                ->onDelete('cascade');
            $table->timestamps();

            $table->index('id_joueur');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('armees');
    }
}
