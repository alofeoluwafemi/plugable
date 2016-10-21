<?php

/**
 * Class Request
 * Stores request information
 * Retrieve request information
 */

namespace Plugable\Classes;

use Plugable\Contracts\RequestInterface;

class Request implements  RequestInterface
{
    /**
     * Stores server information
     * for further manipulation
     * by class
     * @var array
     */
    public $serverDetails;

    /**
     * To hold POST information if any
     * @var array
     */
    public $posts;

    /**
     * To hold GET information if any
     * @var array
     */
    public $gets;


    public function __construct()
    {
        $this->serverDetails    = $_SERVER;
        $this->gets             = isset($_GET)  ? $_GET : array();
        $this->posts            = isset($_POST) ? $_POST : array();
    }

    public function getRequestURI()
    {
        return $this->getSeverDetail('request_uri');
    }

    public function getRequestMethod()
    {
        return $this->getSeverDetail('request_method');
    }

    public function getSeverDetail($key)
    {
        $details    = (object) $this->serverDetails;
        $key        = strtoupper($key);

        return onlyWhenAvailable($details->$key);
    }

    public function all(){}

    public function only(array $list){}

    public function get($key){}

    public function old($key){}

    public function isAjax(){}
}