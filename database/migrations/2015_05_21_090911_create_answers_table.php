<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('answers', function(Blueprint $table)
		{
			$table->increments('id');
            $table->unsignedInteger('question_id');
            $table->unsignedInteger('option_id');
            $table->unsignedInteger('examination_user_id');
            $table->foreign('examination_user_id')->references('id')->on('examination_users');
            $table->foreign('option_id')->references('id')->on('options')->onDelete('cascade');;
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');;
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
		Schema::drop('answers');
	}

}
