<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('player', function(Blueprint $table)
		{
			$table->increments('player_id');
			$table->string('username', 20)->default('')->unique('username');
			$table->string('first_name', 20)->nullable();
			$table->string('last_name', 20)->nullable();
			$table->string('email', 100)->default('')->unique('email');
			$table->string('timezone')->default('UTC');
			$table->boolean('is_admin')->default(0);
			$table->string('password', 32)->default('');
			$table->string('alt_pass', 32)->default('');
			$table->string('ident', 32)->nullable();
			$table->string('token', 32)->nullable();
			$table->timestamp('create_date')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->boolean('is_approved')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('player');
	}

}
