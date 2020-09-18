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
        $config = Config::create($configDir);

        echo "<pre>";
        var_dump($config->db);
        var_dump($config['db']);
    }

    public function run()
    {
        
    }
}