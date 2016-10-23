<?php

/**
 * Application turbo engine
 * Our Container
 */
namespace Plugable\Classes;

use Plugable\Classes\Config as Configuration;
use Plugable\Traits\GetInstance;
use Plugable\Traits\Facade;

class App implements \ArrayAccess
{

    use GetInstance;
    use Facade;

    /**
     * Registered routes
     * @var array
     *
     */
    public $routes;

    /**
     * Registered menus
     * @var array
     */
    public $menus;

    /**
     * Application configuration
     * @var array
     */
    public $config;

    public $instances;

    public function __construct(Configuration $config)
    {
        $this->menus        = array();
        $this->routes       = array();
        $this->instances    = array();

        $this->config       = $config;
    }

    /**
     * @param $key
     * @return null
     */
    public function retrieve($key)
    {
        return $this->offsetGet($key);
    }

    /**
     * @param $key
     * @param $value
     * @return $this
     */
    public function inject($key,$value)
    {
        $this->offsetSet($key,$value);

        return $this;
    }

    /**
     * @param mixed $key
     * @return null
     */
    public function offsetGet($key)
    {
        return $this->offsetExists($key) ? $this->instances[$key] : null;
    }

    /**
     * @param mixed $key
     * @return $this
     */
    public function offsetUnset($key)
    {
        if($this->offsetExists($key)) unset($this->instances[$key]);

        return $this;
    }

    /**
     * @param mixed $key
     * @return bool
     */
    public function offsetExists($key)
    {
       return isset($this->instances[$key]) ? true : false;
    }

    /**
     * @param mixed $key
     * @param mixed $value
     */
    public function offsetSet($key,$value)
    {
        $this->instances[$key] = $value;
    }

    /**
     * Here we take care of the business logic
     * @param $uri
     */
    public function requestResourceController($uri)
    {
        list($controller,$method) = $this['route']->getRouteResource($uri);
    }


    public function run()
    {
        $requestedResource =    $this['request']->getRequestURI();

        $this['hook']->fire('filter.registering',$this);
        $this['hook']->fire('route.registering',$this);
    }
}