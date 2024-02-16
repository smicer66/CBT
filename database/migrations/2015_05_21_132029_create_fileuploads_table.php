<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileuploadsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fileuploads', function(Blueprint $table)
		{
            $table->increments('id');
            $table->string('filename');
            $table->string('mime');
            $table->string('original_filename');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('examination_id');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('examination_id')->references('id')->on('examinations')->onDelete('cascade');;
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fileuploads');
	}

}
