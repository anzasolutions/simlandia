<?php

$time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$start = $time;

require 'core/config/config.php';
require 'app/config/config.php';

Autoload::initialize();

$session = Session::getInstance();
$session->set('start', $start);
Router::dispatch();

?>
