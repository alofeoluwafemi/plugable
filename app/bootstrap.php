<?php

/**
 * We Boot The Application with the
 * following Classes.
 *
 * You can also add a few to boot along side
 */

$app['hook']    = new Plugable\Classes\Hook();
$app['request'] = new Plugable\Classes\Request();
$app['route']   = new Plugable\Classes\Route($app);
$app['theme']   = new Plugable\Classes\Theme($app);