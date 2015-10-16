<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNerdsGroupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('nerds_groups', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('nerd_id'); // ID of the Nerd
			$table->integer('group_id'); //ID of the Group that this nerd is at

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
		Schema::drop('nerds_groups');
	}

}
