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
        $arguments  = func_get_args();

        foreach($arguments as $param)
        {
            print_r($param);
        }
        die;
    }
}

function config($path)
{

}