<?php


/**
 * For developers: team bizmarrow debugging mode.
 *
 * Configure error reporting options
 * Change this to false to enable the display of notices during development.
 */
define('IS_ENV_PRODUCTION', false);

// Turn on error reporting
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', !IS_ENV_PRODUCTION);

// Set error log.
ini_set('error_log', 'log/php-error.txt');

// ** Set time zone to use date/time functions without warnings ** //
date_default_timezone_set('Africa/Lagos'); //http://www.php.net/manual/en/timezones.php

// Include our functions.
// require 'functions.php';


// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database */
define('DB_NAME', 'blog');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_SERVER', 'localhost');

/** Set character set */
define('CHARSET', 'utf8mb4');
