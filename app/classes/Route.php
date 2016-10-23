<?php

namespace Plugable\Classes;

use Plugable\Contracts\RouteInterface;

class Route implements RouteInterface
{
    /**
     * @var array
     */
    public $registeredRoutes;

    public function __construct($app)
    {
        $this->app      = $app;
    }

    /**
     * @param $param
     * @return $this
     * @throws \Exception
     */
    public function addRoute($param)
    {
        $expected   = array(
            'as'        => '',
            'url'       => '',
            'filter'    => '',
            'method'    => 'get',
            'uses'      => '',
        );

        if(empty($param['url']) | empty($param['uses']))
        {
            throw new \Exception('Invalid argument number, no url or controller method supplied');
        }

        $this->registeredRoutes[] = array_merge($expected,$param);

        return $this;
    }

    /**
     * @param $pattern
     * @return $this
     */
    public function where($pattern)
    {
        $last   = count($this->registeredRoutes) - 1;

        $url    = preg_replace('/\//','\/',$this->registeredRoutes[$last]['url']);

        foreach($pattern as $identifier => $regex)
        {
            $url = preg_replace("/{{$identifier}}/",$regex,$url);
        }

        $this->registeredRoutes[$last]['url']   = $url;

        return $this;
    }

    /**
     * @param array $param
     * @return $this
     */
    public function get(array $param)
    {
        $param['method']    = 'get';

        $this->addRoute($param);

        return $this;
    }

    /**
     * @param array $param
     * @return $this
     */
    public function post(array $param)
    {
        $param['method']    = 'get';

        $this->addRoute($param);

        return $this;
    }

    /**
     * @param array $param
     * @return $this
     */
    public function any(array $param)
    {
        $this->get($param)->post($param);

        return $this;
    }

    /**
     * We loop through all registered routes
     * & check if requested routes exist.
     * Else we throw a 404
     *
     * @param $uri
     * @throws \Exception
     */
    public function getRouteResource($uri)
    {
        $routes =   $this->registeredRoutes;

        $route  = current($routes);



        if(end($routes) == $route) throw new \Exception('404 page not found');
    }

    public function filterPasses()
    {

    }

}