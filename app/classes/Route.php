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

        $param['url'] = ltrim( preg_replace('/\//','\/',$param['url']),"/" );

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
        $url    = $this->registeredRoutes[$last]['url'];

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
     * @param $requestedUri
     * @param $requestType
     * @return array
     * @throws \Exception
     */
    public function getRouteResource($requestedUri,$requestType)
    {
        $routes         = $this->registeredRoutes;
        $route          = current($routes);
        $requestedUri   = ltrim($requestedUri,"/");

        $url    = '';
        $filter = '';
        $method = '';
        $uses   = '';

        extract($route);

        echo("/{$url}/")."\t";
        echo($requestedUri)."\t";
        dd(preg_match("!^".$url."$!","/"));

        if(preg_match("!^{$url}$!",$requestedUri) && $method == $requestType)
        {
            if(isset($filter))
            {
                $status = $this->app['filter']->filterRequest($filter);

                if(!$status) die('filter failed');
            }

            return explode('@',$uses);
        }

        if(end($routes) == $route) throw new \Exception('404 page not found');

        $this->getRouteResource($requestedUri,$requestType);
    }


    public function trimRouteTrailingSlash($url)
    {
        return ltrim($url,"/");
    }
}