<?php
/**
 * Created by PhpStorm.
 * User: vitaliy.skoryh
 * Date: 17.09.20
 * Time: 15:05
 */

namespace App;


use App\Config\Config;

class Kernel
{

    /**
     * @var Container
     */
    private $container;

    private $config;

    public function __construct()
    {
        $configDir = 'config';
        $config = new Config();
        $config->parse($configDir);
    }

    public function run()
    {
        
    }
}