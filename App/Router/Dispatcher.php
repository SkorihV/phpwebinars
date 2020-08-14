<?php
namespace App\Router;

use App\Product\ProductController;
use App\Renderer;

/**
 * Created by PhpStorm.
 * User: vitaliy.skoryh
 * Date: 14.08.20
 * Time: 11:10
 */
class Dispatcher
{
    protected $routes = [
        '/products/list' => [ ProductController::class, 'list'],
        '/products/edit' => [ ProductController::class, 'edit'],
        '/products/add' => [ ProductController::class, 'add'],
    ];

    public function dispatch()
    {
        $requestUri = $_SERVER['REQUEST_URI'];
        $requestUri = explode('?', $requestUri);
        $requestUri = $requestUri[0];

        $url = $requestUri ?? '/';

        $route = null;

        foreach ($this->routes as $path => $controller) {
            if ($url == $path) {
                $route = $controller;
                break;
            }
        }

        if (is_null($route)) {
            Renderer::getSmarty()->display('404.tpl');
            exit;
        }


        $class = $route[0];
        $method = $route[1];

        $controller = new $class();

        if (method_exists($controller, $method)) {
            $controller->{$method}();
        } else {
            Renderer::getSmarty()->display('404.tpl');
            exit;
        }


    }
}