<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWrMessageGlueTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('wr_message_glue', function(Blueprint $table)
		{
			$table->increments('message_glue_id');
			$table->integer('message_id')->unsigned()->default(0);
			$table->integer('from_id')->unsigned()->default(0);
			$table->integer('to_id')->unsigned()->default(0);
			$table->dateTime('send_date')->nullable();
			$table->dateTime('expire_date')->nullable()->index('expire_date');
			$table->dateTime('view_date')->nullable();
			$table->timestamp('create_date')->default(DB::raw('CURRENT_TIMESTAMP'))->index('created');
			$table->boolean('deleted')->default(0);
			$table->index(['from_id','message_id'], 'outbox');
			$table->index(['to_id','from_id','send_date','deleted'], 'inbox');
			$table->index(['message_id','to_id'], 'message_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('wr_message_glue');
	}

}
