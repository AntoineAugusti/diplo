<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCasesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cases', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('id_carte')
            	->unsigned()
            	->references('id')
            	->on('cartes')
            	->onDelete('cascade');
            $table->integer('id_joueur')
                ->nullable()
                ->default(null)
                ->unsigned()
                ->references('id')
                ->on('joueurs')
                ->onDelete('cascade');
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
		Schema::drop('cases');
	}

}
