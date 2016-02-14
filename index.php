<?php

$time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$start = $time;


define('PATH_ROOT', getcwd());

require 'core/config/config.php';
require 'app/config/config.php';

Autoload::initialize();

$session = Session::getInstance();
$session->set('start', $start);
Router::dispatch();

?>
