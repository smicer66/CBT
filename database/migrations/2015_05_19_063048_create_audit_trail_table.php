<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuditTrailTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('audit_trail', function(Blueprint $table)
		{
			$table->increments('id');
            $table->timestamp('date_time');
            $table->string('activity');
            $table->unsignedInteger('user_id');
            $table->string('entity');
            $table->unsignedInteger('entity_instance'); // store primary key of entity
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
		Schema::drop('audit_trail');
	}

}