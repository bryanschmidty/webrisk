<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWrGameNudgeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('wr_game_nudge', function(Blueprint $table)
		{
			$table->integer('game_id')->unsigned()->default(0);
			$table->integer('player_id')->unsigned()->default(0);
			$table->timestamp('nudged')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->unique(['game_id','player_id'], 'game_player');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('wr_game_nudge');
	}

}
