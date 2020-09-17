<?php
/**
 * Created by PhpStorm.
 * User: vitaliy.skoryh
 * Date: 17.09.20
 * Time: 17:30
 */

namespace App\Config\Exception;


use App\Exception\AbstractAppException;
use Throwable;

class ConfigFileNotFoundException extends  AbstractAppException
{
    public function __construct($dirname = '', $code = 500, Throwable $previous = null)
    {
        $message = "Config, '$dirname' not found ";
        parent::__construct($message, $code, $previous);
    }
}