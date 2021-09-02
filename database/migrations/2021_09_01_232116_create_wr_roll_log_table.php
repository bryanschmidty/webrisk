<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWrRollLogTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('wr_roll_log', function(Blueprint $table)
		{
			$table->increments('id');
			$table->boolean('attack_1')->default(0);
			$table->boolean('attack_2')->nullable();
			$table->boolean('attack_3')->nullable();
			$table->boolean('defend_1')->default(0);
			$table->boolean('defend_2')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('wr_roll_log');
	}

}
