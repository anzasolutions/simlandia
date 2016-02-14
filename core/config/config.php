<?php

/**
 * File should contain only the most general configuration.
 * All the specific configurations should be located in config folders.
 */

// Map files to constants
define('AUTOLOAD_FILE_CORE', 'core/config/paths.xml');

// Set defaults
// --> below constants must be defined here
// --> but more preferably in application's config.php
//
//define('DEFAULT_APPLICATION_CONTROLLER', '');
//define('DEFAULT_APPLICATION_ACTION', '');
//define('DEFAULT_SESSION_CONTROLLER', '');
//define('DEFAULT_SESSION_ACTION', '');
//define('DEFAULT_REQUEST_CONTROLLER', '');
//define('DEFAULT_REQUEST_ACTION', '');

// File extensions
define('EXT_PHP', '.php');
define('EXT_CLASS_PHP', '.class.php');
define('EXT_INTERFACE_PHP', '.interface.php');
define('EXT_CSS', '.css');
define('EXT_JS', '.js');
define('EXT_HTML', '.html');
define('EXT_PROPS', '.properties');
define('EXT_PNG', '.png');
define('EXT_JPG', '.jpg');
define('EXT_GIF', '.gif');

// Special characters
define('COMMA', ',');
define('DOT', '.');
define('UNDERLINE', '_');
define('PIPE', '|');
define('BACKSLASH', '\\');
define('SLASH', '/');
define('COLON', ':');
define('SEMICOLON', ';');
define('TRIM_PATTERN', ' /\\');
define('HTTP', 'http://');
define('DASH', '-');
define('SPACE', ' ');
define('PERCENT', '%');
define('STAR', '*');
define('EQUALS', '=');
define('SQUOTE', '\'');
define('LBRACKET', '(');
define('RBRACKET', ')');

// Object types
define('CONTROLLER', 'Controller');
define('MODEL', 'Model');
define('VIEW', 'View');
define('DAO', 'DAO');
define('DRIVER', 'Driver');

// System paths
$ex = explode('/', $_SERVER['REQUEST_URI']);
define('NAME_APP', $ex[1]);
define('PATH_APP', getcwd() . SLASH);
define('URL_APP', HTTP . $_SERVER['SERVER_NAME'] . SLASH . NAME_APP . SLASH);
define('PATH_WEB', PATH_APP . 'web' . SLASH);
define('PATH_TEMPLATES', PATH_WEB . 'templates' . SLASH);
define('PATH_MESSAGES', PATH_APP . 'resources' . SLASH);
define('URL_WEB', URL_APP . 'web' . SLASH);
define('URL_JS', URL_WEB . 'js' . SLASH);
define('URL_CSS', URL_WEB . 'css' . SLASH);
define('URL_IMG', URL_WEB . 'images' . SLASH);

// Class loader
require 'core/system/autoload.class.php';
require 'lib/addendum/annotations.php';

?>