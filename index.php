<?php
/**
 * Great codes are as result of evolution,
 * not intelligent design.
 *
 * That means letting Go of the God
 * Complex
 *
 */

date_default_timezone_set('UTC');

error_reporting(E_ALL);

ini_set('display_errors','1');

require "vendor/autoload.php";

/**
 * From her we kick off =o=o=
 */
$app    = new Plugable\Classes\App(new Plugable\Classes\Config());

/**
 * Bootstrap a few classes with
 * the application
 */
require "app/bootstrap.php";

/**
 * Autoload some files such as our with the
 * application
 */
require "app/autoload.php";

$app->run();