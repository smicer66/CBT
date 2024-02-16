<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('settings', function(Blueprint $table) {
			$table->increments('id');
            $table->string('key', 100);
			$table->string('value', 100);
			$table->unsignedInteger('examination_id');
			$table->foreign('examination_id')->references('id')->on('examinations');
            $table->unique(array('key', 'examination_id'));
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('settings');
	}

}
