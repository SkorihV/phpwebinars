<?php
/**
 * Created by PhpStorm.
 * User: vitaliy.skoryh
 * Date: 14.08.20
 * Time: 11:16
 */

namespace App\Renderer;

use \Smarty;

class Renderer
{
    protected static $smarty;

    protected $_smarty;

    public function __construct(Smarty $smarty)
    {
        $this->_smarty = $smarty;
    }

    public static function getSmarty()
    {
        if (is_null(static::$smarty)){
            static::init();
        }
        
        return static::$smarty;
    }

    protected static function init()
    {
        $smarty = new Smarty();

        $smarty->template_dir = APP_DIR . '/templates';
        $smarty->compile_dir = APP_DIR . '/var/compile';
        $smarty->config_dir = APP_DIR . '/var/configs';
        $smarty->cache_dir = APP_DIR . '/var/cache';

        static::$smarty = $smarty;
    }

    /**
     * @param string $template
     * @param array $data
     **/
    public function render(string $template, array $data = [])
    {

        foreach ($data as $key => $value) {
            $this->_smarty->assign($key, $value);
        }

        return $this->_smarty->fetch($template);
    }

}