<?php
/**
 * Filters to protect routes
 */

$app['filter']->addFilter('csrf',function() { return true; });