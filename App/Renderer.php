<?php
/**
 * Created by PhpStorm.
 * User: vitaliy.skoryh
 * Date: 14.08.20
 * Time: 11:16
 */

namespace App;


class Renderer
{
    protected static $smarty;

    public static function getSmarty()
    {
        if (is_null(static::$smarty)){
            static::init();
        }
        
        return static::$smarty;
    }

    protected static function init()
    {

        $smarty = new \Smarty();

        $smarty->template_dir = APP_DIR . '/templates';
        $smarty->compile_dir = APP_DIR . '/var/compile';
        $smarty->config_dir = APP_DIR . '/var/configs';
        $smarty->cache_dir = APP_DIR . '/var/cache';

        static::$smarty = $smarty;
    }

}