<?php

namespace Plugable\Contracts;

interface RequestInterface{

    /**
     * Retrieve a key value from either
     * $_GET or $_POST
     * @param $key
     * @return mixed
     */
    public function get($key);

    /**
     * Retrieve an old input value from
     * $_POST
     * @param $key
     * @return mixed
     */
    public function old($key);

    /**
     * Detect if request is
     * xmlHTTP
     * @return mixed
     */
    public function isAjax();

    /**
     * Retrieve a list of key values from
     * $_POST
     * @param array $list
     * @return mixed
     */
    public function only(array $list);

    /**
     * Retrieve all key values from
     * $_POST
     * @return mixed
     */
    public function all();
}