<?php

// ----------------------------------------------------------
// DO NOT MODIFY THIS FILE UNLESS YOU KNOW WHAT YOU ARE DOING
// ----------------------------------------------------------

/* Database settings */
/* ----------------- */
	$GLOBALS['_DEFAULT_DATABASE']['hostname'] = config('database.connections.mysql.host'); // the URI of the MySQL server host
	$GLOBALS['_DEFAULT_DATABASE']['username'] = config('database.connections.mysql.username'); // the MySQL user's name
	$GLOBALS['_DEFAULT_DATABASE']['password'] = config('database.connections.mysql.password'); // the MySQL user's password
	$GLOBALS['_DEFAULT_DATABASE']['database'] = config('database.connections.mysql.database'); // the MySQL database name
	$GLOBALS['_DEFAULT_DATABASE']['log_path'] = LOG_DIR; // the MySQL log path


/* Root settings */
/* ------------- */
	$GLOBALS['_ROOT_ADMIN']  = config('webrisk.root_admin'); // Permanent admin username (case-sensitive)
	$GLOBALS['_ROOT_URI']    = config('app.url'); // The root URL of the game script (include closing / )
	$GLOBALS['_USEEMAIL']    = config('webrisk.use_email'); // SMTP operations.  Test it before putting it into production
	$GLOBALS['_DETECTHACKS'] = config('webrisk.detect_hacks'); // hack detection. disable this if it causes problems


/* Date settings */
/* ------------- */
	$GLOBALS['_DEFAULT_TIMEZONE'] = config('app.timezone'); // Your timezone (http://php.net/manual/en/timezones.php)


/* Table settings */
/* -------------- */
	$master_prefix = ''; // master database table prefix
	$game_prefix   = 'wr_'; // game table name prefix

	// note this table does not have the same prefix as the other tables
	define('T_PLAYER'      , $master_prefix . 'player'); // the player data table (NOTE: THERE IS NO GAME PREFIX)

	define('T_CHAT'        , $master_prefix . $game_prefix . 'chat'); // the in-game chat/personal notes table
	define('T_GAME'        , $master_prefix . $game_prefix . 'game'); // the game data table
	define('T_GAME_PLAYER' , $master_prefix . $game_prefix . 'game_player'); // the game player glue table
	define('T_GAME_LAND'   , $master_prefix . $game_prefix . 'game_land'); // the game land glue table
	define('T_GAME_NUDGE'  , $master_prefix . $game_prefix . 'game_nudge'); // the game nudge table
	define('T_GAME_LOG'    , $master_prefix . $game_prefix . 'game_log'); // the game log table
	define('T_MESSAGE'     , $master_prefix . $game_prefix . 'message'); // the message table
	define('T_MSG_GLUE'    , $master_prefix . $game_prefix . 'message_glue'); // the player messaging glue table
	define('T_ROLL_LOG'    , $master_prefix . $game_prefix . 'roll_log'); // the roll log table
	define('T_SETTINGS'    , $master_prefix . $game_prefix . 'settings'); // the settings table
	define('T_WEBRISK'     , $master_prefix . $game_prefix . 'wr_player'); // the webrisk player data table

