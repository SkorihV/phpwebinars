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
        '/products/edit/{id}' => [ ProductController::class, 'edit'],
        '/products/add' => [ ProductController::class, 'add'],
        '/products/delete' => [ ProductController::class, 'delete'],
        '/products/delete_image' => [ ProductController::class, 'deleteImage'],

        '/categories/list' => [ CategoryController::class, 'list'],
        '/categories/edit' => [ CategoryController::class, 'edit'],
        '/categories/add' => [ CategoryController::class, 'add'],
        '/categories/delete' => [ CategoryController::class, 'delete'],
        '/categories/view' => [ CategoryController::class, 'view'],

        '/categories/view/{id}' => [ CategoryController::class, 'view'],
        '/categories/{id}/view' => [ CategoryController::class, 'view'],

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
        $controllerParams = [];
        echo "<pre>";
        var_dump($this->routes);
        foreach ($this->routes as $path => $controller) {
            $isSmartPath = strpos($path, '{');
            if ($url == $path) {
                $route = $controller;
                break;
            } else if ($isSmartPath) {


                $isEqual = false;
                $urlChunks = explode('/', $url);
                $pathChunks = explode('/', $path);

                echo "<pre>";
                var_dump($pathChunks, $urlChunks);
//                if (count($urlChunks) != count($pathChunks)){
//                    break;
//                }

                $controllerParams = [];


                for ($i =0; $i < count($pathChunks); $i++) {
                    $urlChunk = $urlChunks[$i];
                    $pathChunk = $pathChunks[$i];

                    $isSmartChunk = strpos($pathChunk, '{') !== false && strpos($pathChunk, '}') !== false;

                    if ($urlChunk == $pathChunk) {
                        $isEqual = true;
                    } else if ($isSmartChunk) {
                        $paramName = str_replace(['{', '}'], '', $pathChunk);
                        $controllerParams[$paramName] = $urlChunk;
                        $isEqual = true;
                        break;
                    } else {
                        $controllerParams = [];
                        $isEqual = false;
                        break;
                    }
                }

                if (!$isEqual) {
                    continue;
                }

                if ($isEqual === true) {
                    $route = $controller;
                    break;
                }
            }
        }

        if (is_null($route)) {
            Renderer::getSmarty()->display('404.tpl');
            exit;
        }


        $class = $route[0];
        $method = $route[1];

//        echo "<pre>";
//        var_dump($class, $method, $controllerParams);
//        echo "</pre>";


        $controller = new $class($controllerParams);

        if (method_exists($controller, $method)) {
            $controller->{$method}();
        } else {
            Renderer::getSmarty()->display('404.tpl');
            exit;
        }


    }
}