<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddUniqueKeyToAnswersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('answers', function(Blueprint $table)
		{
			$table->unique(array('question_id', 'option_id', 'examination_user_id'));
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('answers', function(Blueprint $table)
		{

//			$table->dropUnique(array('question_id', 'option_id', 'examination_user_id'));

        });
	}

}
