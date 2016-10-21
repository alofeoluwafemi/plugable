<?php

/**
 * Boot Application with the
 * following Classes
 */

$app['hook']    = new \Plugable\Classes\Hook();
$app['request'] = new \Plugable\Classes\Request();
$app['route']   = new \Plugable\Classes\Route($app);