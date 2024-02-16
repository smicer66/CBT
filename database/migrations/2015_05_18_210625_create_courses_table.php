<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCoursesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('courses', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('title', 100);
            $table->string('code', 10);
            $table->unsignedInteger('department_offering');
            $table->foreign('department_offering')->references('id')->on('departments')->onDelete('cascade');;
			$table->timestamps();
            $table->softDeletes();

        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('courses');
	}

}
