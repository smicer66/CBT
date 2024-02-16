<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMaximumScoreFieldToExaminationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('examinations', function(Blueprint $table)
		{
			$table->double('maximum_score');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('examinations', function(Blueprint $table)
		{
			$table->dropColumn('maximum_score');
		});
	}

}
