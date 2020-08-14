<?php
namespace App\Router;

use App\Category\CategoryController;
use App\Product\ProductController;
use App\Queue\QueueController;
use App\Import\ImportController;
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
        '/products/delete' => [ ProductController::class, 'delete'],
        '/products/delete_image' => [ ProductController::class, 'deleteImage'],

        '/categories/list' => [ CategoryController::class, 'list'],
        '/categories/edit' => [ CategoryController::class, 'edit'],
        '/categories/add' => [ CategoryController::class, 'add'],
        '/categories/delete' => [ CategoryController::class, 'delete'],
        '/categories/view' => [ CategoryController::class, 'view'],

        '/categories/view/{id}' => [ CategoryController::class, 'view'],

        '/queue/run' => [ QueueController::class, 'run'],
        '/queue/list' => [ QueueController::class, 'list'],

        '/imports/index' => [ ImportController::class, 'index'],
        '/imports/upload' => [ ImportController::class, 'upload'],



    ];

    public function dispatch()
    {
        $requestUri = $_SERVER['REQUEST_URI'];
        $requestUri = explode('?', $requestUri);
        $requestUri = $requestUri[0];

        $url = $requestUri ?? '/';

        $route = null;

        var_dump($url);
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