<?php

namespace App\Config\Exception;

use App\Exception\AbstractAppException;
use Throwable;

/**
 * Created by PhpStorm.
 * User: vitaliy.skoryh
 * Date: 17.09.20
 * Time: 15:52
 */
class ConfigDirectoryNotFoundException extends  AbstractAppException
{
    public function __construct($dirname = '', $code = 500, Throwable $previous = null)
    {
        $message = "Directory, '$dirname' not found exception";
        parent::__construct($message, $code, $previous);
    }
}