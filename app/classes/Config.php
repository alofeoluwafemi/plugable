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
        
        $this->configuration =  $config;
    }

    /**
     * @param $key
     * @param null $value
     * @return $this
     */
    public function set($key, $value = null)
    {
        $match = (preg_match('/\./',$key,$matches));

        if(!$match) $this->configuration[$key] = $value;

        $path   =   explode('.',$key);
        $result =   null;

        foreach($path as $depth)
        {

        }
        return $this;
    }

    /**
     * @param $key
     * @return null
     */
    public function get($key)
    {
        $match = (preg_match('/\./',$key,$matches));

        if(!$match) return onlyWhenAvailable($this->configuration[$key]);

        $path   =   explode('.',$key);
        $result =   null;

        foreach($path as $depth)
        {
            $result = onlyWhenAvailable($result,$this->configuration)[$depth];
        }

        return $result;
    }

}