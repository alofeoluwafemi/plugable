<?php

/**
 * Turn On the Light
 */

date_default_timezone_set('UTC');

error_reporting(E_ALL);

ini_set('display_errors','1');

require "vendor/autoload.php";

$app    = new Plugable\Classes\App(new Plugable\Classes\Config());

require "app/bootstrap.php";

$app->run();