<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWrGameTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('wr_game', function(Blueprint $table)
		{
			$table->increments('game_id');
			$table->integer('host_id')->unsigned()->default(0);
			$table->string('name')->default('');
			$table->string('password', 32)->nullable();
			$table->boolean('capacity')->default(2);
			$table->boolean('time_limit')->nullable();
			$table->boolean('allow_kibitz')->default(0);
			$table->string('game_type')->nullable()->default('Original');
			$table->boolean('next_bonus')->default(4);
			$table->enum('state', array('Waiting','Placing','Playing','Finished'))->default('Waiting');
			$table->text('extra_info')->nullable();
			$table->text('game_settings')->nullable();
			$table->boolean('paused')->default(0);
			$table->dateTime('create_date')->default('0000-00-00 00:00:00');
			$table->dateTime('modify_date')->default('0000-00-00 00:00:00');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('wr_game');
	}

}
