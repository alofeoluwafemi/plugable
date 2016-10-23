<?php

namespace Plugable\Contracts;

interface RouteInterface{

    public function get(array $param);

    public function post(array $param);

    public function any(array $param);

}