<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExaminationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('examinations', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('title');
            $table->integer('no_of_questions');
            $table->unsignedInteger('course_id');
            $table->double('question_score_weight')->nullable();
            $table->timestamp('exam_date'); //the date and time the exam starts
            $table->integer('duration'); //How long the exam will last in seconds
            $table->enum('status', ['active', 'inactive', 'archived']); //Used to set or unset the exam
            $table->text('instructions');
            $table->enum('question_delivery', ['random', 'linear']);
            $table->softDeletes(); // adds a deleted_at column to allow softDeleteTrait
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
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
		Schema::drop('examinations');
	}

}
