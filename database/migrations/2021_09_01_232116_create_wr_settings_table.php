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

		DB::table('wr_settings')->insert([
            ['setting' => 'site_name', 'value' => 'Your Site Name', 'notes' =>'The name of your site', 'sort' => 10],
            ['setting' => 'default_color', 'value' => 'c_yellow_black.css', 'notes' =>'The default theme color for the game pages', 'sort' => 20],
            ['setting' => 'nav_links', 'value' => '<!-- your links here -->', 'notes' =>"'HTML code for your site's navigation links to display on the game pages'", 'sort' => 30],
            ['setting' => 'from_email', 'value' => 'your.mail@yoursite.com', 'notes' =>'The email address used to send game emails', 'sort' => 40],
            ['setting' => 'to_email', 'value' => 'you@yoursite.com', 'notes' =>'The email address to send admin notices to (comma separated)', 'sort' => 50],
            ['setting' => 'new_users', 'value' => '1', 'notes' =>'(1/0) Allow new users to register (0 = off)', 'sort' => 60],
            ['setting' => 'approve_users', 'value' => '0', 'notes' =>'(1/0) Require admin approval for new users (0 = off)', 'sort' => 70],
            ['setting' => 'confirm_email', 'value' => '0', 'notes' =>'(1/0) Require email confirmation for new users (0 = off)', 'sort' => 80],
            ['setting' => 'max_users', 'value' => '0','notes' => 'Max users allowed to register (0 = off)','sort' =>  90],
            ['setting' => 'default_pass', 'value' => 'default', 'notes' =>"'The password to use when resetting a user's password'", 'sort' => 100],
            ['setting' => 'expire_users', 'value' => '45', 'notes' =>'Number of days until untouched user accounts are deleted (0 = off)', 'sort' => 110],
            ['setting' => 'save_games', 'value' => '0', 'notes' =>"(1/0) Save games in the 'games' directory on the server (0 = off)", 'sort' => 120],
            ['setting' => 'expire_finished_games', 'value' => '7', 'notes' =>'Number of days until finished games are deleted (0 = off)', 'sort' => 128],
            ['setting' => 'expire_games', 'value' => '30', 'notes' =>'Number of days until untouched games are deleted (0 = off)', 'sort' => 130],
            ['setting' => 'nudge_flood_control', 'value' => '24', 'notes' =>'Number of hours between nudges. (-1 = no nudging, 0 = no flood control)', 'sort' => 135],
            ['setting' => 'timezone', 'value' => 'UTC', 'notes' =>'The timezone to use for dates (<a href="http://www.php.net/manual/en/timezones.php">List of Timezones</a>)', 'sort' => 140],
            ['setting' => 'long_date', 'value' => 'M j, Y g:i a', 'notes' =>'The long format for dates (<a href="http://www.php.net/manual/en/function.date.php">Date Format Codes</a>)', 'sort' => 150],
            ['setting' => 'short_date', 'value' => 'Y.m.d H:i', 'notes' =>'The short format for dates (<a href="http://www.php.net/manual/en/function.date.php">Date Format Codes</a>)', 'sort' => 160],
            ['setting' => 'debug_pass', 'value' => '', 'notes' =>'The DEBUG password to use to set temporary DEBUG status for the script (empty = off)', 'sort' => 170],
            ['setting' => 'DB_error_log', 'value' => '0', 'notes' =>"(1/0) Log database errors to the 'logs' directory on the server (0 = off)", 'sort' => 180],
            ['setting' => 'DB_error_email', 'value' => '0', 'notes' =>'(1/0) Email database errors to the admin email addresses given (0 = off)', 'sort' => 190],
        ]);
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
