<?php

if(!function_exists('onlyWhenAvailable'))
{
    /**
     * @param $value
     * @param null $default
     * @return mixed
     */
    function onlyWhenAvailable($value,$default = null)
    {
        return isset($value) ? $value : $default;
    }
}

if(!function_exists('dd'))
{
    /**
     * Die-Dump
     * @param $data
     */
    function dd($data)
    {
        var_dump(func_get_args());
        die;
    }
}