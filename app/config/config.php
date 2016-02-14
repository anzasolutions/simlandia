<?php

/**
 * Application configuration only!
 */

// Map files to constants
define('AUTOLOAD_FILE_APP', 'app/config/paths.xml');
define('DB_FILE', 'app/config/db.xml');
define('LOG_CONFIG_FILE', 'log4php.properties');

// Set defaults
define('DEFAULT_APPLICATION_CONTROLLER', 'default');
define('DEFAULT_APPLICATION_ACTION', '');
define('DEFAULT_SESSION_CONTROLLER', 'friends');
define('DEFAULT_SESSION_ACTION', '');
define('DEFAULT_REQUEST_CONTROLLER', 'auth');
define('DEFAULT_REQUEST_ACTION', 'login');

// File extensions
// --> Here you can put required file extensions

// Special characters
// --> Here you can put required special characters

// System paths
define('URL_PHOTOS', URL_APP . 'photos' . SLASH);

?>