<?php
/**
 * Created by PhpStorm.
 * User: Валерий
 * Date: 28.02.2016
 * Time: 16:16
 */
class Register {

    private static $_values;

    private static $_instance;

    public static function getInstance()
    {
        if (!(self::$_instance instanceof self)) {
            $className = __CLASS__;
            self::$_instance = new $className;
        }
        return self::$_instance;
    }
    private function __construct(){}

    public static function add($name, $value) {
        self::$_values[$name] = $value;
    }

    public static function get($name)
    {
        if (array_key_exists($name, self::$_values))
        {
            return self::$_values[$name];
        } else {
            throw new Exception ("Error value");
        }
    }

    public static function set($name, $value)
    {
        self::$_values[$name] = $value;
    }

    public static function remove($name)
    {
        unset(self::$_values[$name]);
    }
}