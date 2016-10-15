<?php

/**
 * Get application configuration &
 * set configuration
 */

namespace Plugable\Classes;

use Plugable\Contracts\ConfigInterface as ConfigInterface;

class Config implements ConfigInterface
{
    public function __construct()
    {
        $baseDir    = dirname(dirname(__DIR__));
        $config     = require("{$baseDir}/config.php");
        
        $this->configuration = json_encode($config);
    }

    /**
     * @param $key
     * @param null $value
     * @return $this
     */
    public function set($key, $value = null)
    {
        $this->configuration->$key = $value;

        return $this;
    }

    /**
     * @param $key
     * @return null
     */
    public function get($key)
    {
        $value = isset($this->configuration->$key) ? $this->configuration->$key : NULL;
        return $value;
    }

}