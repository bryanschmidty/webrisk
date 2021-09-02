<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWrGameLogTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('wr_game_log', function(Blueprint $table)
		{
			$table->integer('game_id')->unsigned()->default(0);
			$table->string('data')->nullable();
			$table->dateTime('create_date')->default('0000-00-00 00:00:00.000000');
			$table->decimal('microsecond', 18, 8)->default(0.00000000);
			$table->unique(['game_id','create_date','microsecond'], 'game_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('wr_game_log');
	}

}
