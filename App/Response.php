<?php

namespace App;

/**
 * Class Response
 * @package App
 */
class Response
{
    public function redirect(string $url = "/"){
        header('Location: ' . $url);
    }
}