<?php

/**
 * @author Peter Kullmann
 * This file contains program configuration constants
 */


/*
 * Settings for database access.
 */

/**
 * the database host address
 */

define('DEFAULT_DBHOST', $_ENV['DB_HOST']);

/**
 * the database name
 */

define('DEFAULT_DBNAME', $_ENV['DB_NAME']);

/**
 * the database user name
 */

define('DEFAULT_DBUSER', $_ENV['DB_USER']);

/**
 * the database password
 */

define('DEFAULT_DBPASSWORD', $_ENV['DB_PASSWORD']);

/**
 * Email address for sending error messages
 */

define('ADMIN_MAILTO','info@elementec.de');

/**
 * Enable mailing of error messages.
 */

define('ENABLE_MAIL',false);

/**
 * Enable tracing.
 */

define('ENABLE_TRACE',false);

/**
 * Enable error output.
 */

define('ENABLE_ECHO',true);

/**
 * Default date and time format.
 */

define('DEFAULT_FMTDATETIME','Y-m-d H:i:s');

?>