<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWrGamePlayerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('wr_game_player', function(Blueprint $table)
		{
			$table->integer('game_id')->unsigned()->default(0);
			$table->integer('player_id')->unsigned()->default(0);
			$table->boolean('order_num')->default(0);
			$table->string('color', 10)->default('');
			$table->string('cards')->nullable();
			$table->smallInteger('armies')->unsigned()->default(0);
			$table->enum('state', array('Waiting','Trading','Placing','Attacking','Occupying','Fortifying','Resigned','Dead'))->default('Waiting');
			$table->boolean('get_card')->default(0);
			$table->boolean('forced')->default(0);
			$table->text('extra_info')->nullable();
			$table->dateTime('move_date')->default('0000-00-00 00:00:00');
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
		Schema::drop('wr_game_player');
	}

}
