<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArmeesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('armees', function(Blueprint $table)
		{
			$table->increments('id');
			$table->enum('type', ['TERRESTRE', 'MARITIME']);
			$table->integer('id_joueur')->unsigned();
			$table->integer('id_case')->unsigned();
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
		Schema::drop('armees');
	}

}
