<?php

/**
 * We register event for route registering,
 * for the benefit of plugins to hook to
 * the event.
 */
$app['hook']->register('filter.registering',function(){});

/**
 * Route Filters that ships with application
 */
require "filters.php";


/**
 * We register event for filter registering,
 * for the benefit of plugins to hook to
 * the event.
 */
$app['hook']->register('route.registering',function(){});

/**
 * Here we load in application routes
 */
require "routes.php";