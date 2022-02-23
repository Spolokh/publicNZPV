<?php

/*
 * config v 1.0
 */

defined('rootpath') or die;

class Config
{
    private static $config = [];
    
    /*
     * @access - public
     */
    
    public static function init($config)
    {
        self::$config = $config;
    }

    /*
     * @access - public
     */
    public static function get($key)
    {
        return self::$config[$key] ?? false;
    }

    /*
     * @access - public
     */
    public static function set($param, $value)
    {
        self::$config[$param] = $value;
    }

    /**
     * @access - public
     */
    public static function has($param)
    {
       isset(self::$config[$param]);
    }
    
    /**
     * @access - public
     * @return - Ð½Ð°ÑÑ‚Ñ€Ð¾Ð¹ÐºÐ°
     *
     */
    
    public static function dsn($param = null)
    {
        return self::get('database').':host='.self::get('dbhost').';dbname='.self::get('dbname');
    }
}
