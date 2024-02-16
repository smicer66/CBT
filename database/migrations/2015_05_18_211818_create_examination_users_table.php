<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExaminationUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('examination_users', function(Blueprint $table)
		{
			$table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('examination_id');
            $table->double('result')->nullable();
            $table->unsignedInteger('level');
            $table->timestamp('started_at');
            $table->timestamp('stopped_at');
            $table->string('unique_exam_code');
            $table->enum('status', ['active', 'inactive']);
			$table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('examination_id')->references('id')->on('examinations');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('examination_users');
	}

}
