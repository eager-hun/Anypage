<?php

/**
 * Class Capacities
 *
 * Responsible for carrying around and exposing all the processing methods that
 * business logic needs.
 */
class Capacities
{

    protected static $items = [];

    public static function bind($key, $value)
    {
        static::$items[$key] = $value;
    }

    public static function get($key)
    {
        if (! array_key_exists($key, static::$items))
        {
            throw new Exception("Could not find requested item among Capacities.");
        }

        return static::$items[$key];
    }
}
