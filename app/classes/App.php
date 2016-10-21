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

        $this->config       = $config->configuration;
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


    public function run()
    {
        //Testing hook with below brief implementation
//        $this['hook']->register('booting',function($value,$added,$service)
//        {
//            $this->menus['Home'] = array('href' => '/home','title' => 'Home','data-title' => 'home');
//        });

        $requestedResource =    $this['request']->getRequestURI();

        require "{$this->config->base_dir}app/filters.php";

        require "{$this->config->base_dir}app/routes.php";

//        $this['hook']->fire('booting','value',array('added','services'));

        dd($this);
    }
}