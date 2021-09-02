<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWrWrPlayerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('wr_wr_player', function(Blueprint $table)
		{
			$table->integer('player_id')->unsigned()->default(0)->unique('id');
			$table->text('game_settings')->nullable();
			$table->boolean('is_admin')->default(0);
			$table->boolean('allow_email')->default(1);
			$table->string('color', 25)->default('yellow_black');
			$table->boolean('invite_opt_out')->default(0);
			$table->boolean('max_games')->default(0);
			$table->smallInteger('wins')->unsigned()->default(0);
			$table->smallInteger('kills')->unsigned()->default(0);
			$table->smallInteger('losses')->unsigned()->default(0);
			$table->dateTime('last_online')->default('0000-00-00 00:00:00');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('wr_wr_player');
	}

}
