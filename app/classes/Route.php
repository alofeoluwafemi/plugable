<?php

namespace Plugable\Classes;

use Plugable\Contracts\RouteInterface;

class Route implements RouteInterface
{
    public $pattern;

    public $filter;

    public $method;

    public function __construct($app)
    {
        $this->app = $app;
        $this->addRoute(['as'=> '', 'url'=> '', 'filter'=> '','method'=> '','uses'=> '']);
    }

    public function addRoute($info)
    {
        $expected   = array(
            'as'        => '',
            'url'       => '',
            'filter'    => '',
            'method'    => '',
            'uses'      => ''
        );

        $summation = array_merge($expected,$info);

        $this->app->routes['democracy']= $summation;
    }

    public function get(array $param)
    {

    }

    public function post(array $param)
    {

    }

    public function any(array $param)
    {

    }

    public function filterPasses()
    {

    }

}