<?php

/**
 * Trait to enable calling of class
 * methods as if they were static
 */
namespace Plugable\Traits;

trait Facade
{
    public static function __callStatic($method,$params)
    {

    }
}