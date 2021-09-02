<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWrGameLandTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('wr_game_land', function(Blueprint $table)
		{
			$table->integer('game_id')->unsigned()->default(0);
			$table->integer('land_id')->unsigned()->default(0);
			$table->integer('player_id')->unsigned()->default(0);
			$table->smallInteger('armies')->unsigned()->default(0);
			$table->unique(['game_id','land_id'], 'game_land');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('wr_game_land');
	}

}
