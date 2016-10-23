<?php

namespace Plugable\Classes;

class Filter
{
    /**
     * Holds all our registered filter
     * for our application
     * @var array
     */
    public $registeredFilters;

    public function __construct($app)
    {
        $this->app  = $app;
    }

    /**
     * @param $identifier
     * @param $callback
     */
    public function addFilter($identifier,$callback)
    {
        $this->registeredFilters[$identifier]  =  $callback;
    }

    /**
     * @param $identifier
     * @return bool
     */
    public function filterExist($identifier)
    {
        $result = array_key_exists($identifier,$this->registeredFilters);

        if($result) return true;

        return false;
    }

    /**
     * Check if request passes route
     * filter condition
     * @param $identifier
     * @return bool
     * @throws \Exception
     */
    public function filterRequest($identifier)
    {
        if(!$this->filterExist($identifier)) throw new \Exception("Unregistered filter {$identifier} used ");

        $filter = $this->registeredFilters[$identifier];

        $passes = call_user_func($filter);

        return $passes;
    }
}