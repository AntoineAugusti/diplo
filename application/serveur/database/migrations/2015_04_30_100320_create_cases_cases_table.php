<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCasesCasesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cases_cases', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('case_parente')->unsigned()->references('id')->on('cases')->onDelete('cascade');
            $table->integer('case_voisine')->unsigned()->references('id')->on('cases')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cases_cases');
	}

}
