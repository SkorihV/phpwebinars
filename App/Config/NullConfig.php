<?php
/**
 * Created by PhpStorm.
 * User: vitaliy.skoryh
 * Date: 18.09.20
 * Time: 16:16
 */

namespace App\Config;


class NullConfig
{
    public function __get(string $key)
    {
        return $this;
    }
}