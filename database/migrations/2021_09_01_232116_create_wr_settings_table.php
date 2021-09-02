<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWrSettingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('wr_settings', function(Blueprint $table)
		{
			$table->string('setting')->default('')->unique('setting');
			$table->text('value');
			$table->text('notes')->nullable();
			$table->smallInteger('sort')->unsigned()->default(0)->index('sort');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('wr_settings');
	}

}
