<?php

namespace Plugable\Classes;

class Hook
{

    /**
     * @var array
     */
    public $events;

    public function __construct()
    {
        $this->events   = array();
    }

    /**
     * @param $eventName
     * @param $callback
     * @param int $priority
     * @internal param null $param
     */
    public function register($eventName,$callback,$priority = 1)
    {
        if(isset($this->events[$eventName]))
        {
            $this->events[$eventName][] = array('callback' => $callback,'priority' => $priority);
        }
    }

    /**
     * @param $eventName
     * @param $value
     * @param array $params
     * @return mixed|null|void
     */
    public function fire($eventName,$value,$params = array() )
    {
        $hooks  = $this->events[$eventName];
        $result = null;

        if(!isset($hook)) return;

        $params = array_merge(array($value),$params);

        foreach($hooks as $hook)
        {
           $result = call_user_func($hook['callback'],$params);
        }

        return $result;
    }
}