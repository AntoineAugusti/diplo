<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ordres', function(Blueprint $table)
		{
			$table->increments('id');
			$table->enum('type', ['Attaquer', 'SoutienDefensif', 'SoutienOffensif', 'Tenir']);
            $table->integer('id_armee')
                ->unsigned()
                ->references('id')
                ->on('armees')
                ->onDelete('cascade');
            $table->integer('id_case')
                ->unsigned()
                ->references('id')
                ->on('cases')
                ->onDelete('cascade')
                ->nullable();
            $table->boolean('execute')->default(false);
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
		Schema::drop('ordres');
	}

}
