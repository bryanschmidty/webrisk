<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWrChatTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('wr_chat', function(Blueprint $table)
		{
			$table->increments('chat_id');
			$table->text('message');
			$table->integer('from_id')->unsigned()->default(0)->index('from_id');
			$table->integer('game_id')->unsigned()->default(0)->index('game_id');
			$table->boolean('private')->default(0)->index('private');
			$table->timestamp('create_date')->default(DB::raw('CURRENT_TIMESTAMP'));
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('wr_chat');
	}

}
