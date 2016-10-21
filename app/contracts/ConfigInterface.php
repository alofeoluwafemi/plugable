<?php

namespace Plugable\Contracts;

interface ConfigInterface{

    public function get($key);

    public function set($key,$value = null);
}