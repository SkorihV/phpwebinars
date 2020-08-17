<?php
namespace App\Router;

use App\Category\CategoryController;
use App\Product\ProductController;
use App\Queue\QueueController;
use App\Import\ImportController;
use App\Renderer;
use App\Request;
use App\Router\Exception\MethodDoesNotExistException;
use App\Router\Exception\NotFoundException;

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
        '/products/{id}/edit' => [ ProductController::class, 'edit'],
        '/products/add' => [ ProductController::class, 'add'],
        '/products/delete' => [ ProductController::class, 'delete'],
        '/products/delete_image' => [ ProductController::class, 'deleteImage'],

        '/categories/list' => [ CategoryController::class, 'list'],
        '/categories/edit' => [ CategoryController::class, 'edit'],
        '/categories/edit/{id}' => [ CategoryController::class, 'edit'],
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

    /**
     * @return mixed
     */
    public function dispatch()
    {
        $url = Request::getUrl();

        $route = new Route($url);

        foreach ($this->routes as $path => $controller) {
            if ($this->isValidPath($path, $route)){
                break;
            }
        }
// Выдает ошибку на |
//        try {
//            $route->execute();
//        } catch (NotFoundException | MethodDoesNotExistException $e) {
//            $this->error404();
//        }

        try {
            $route->execute();
        } catch (NotFoundException $e) {
            $this->error404();
        }

    }

    public function isValidPath(string $path, Route $route) {
        $controller = $this->routes[$path];


        $isValidPath = $route->isValidPath($path);
        if ($isValidPath) {
            $route->setController($controller[0]);
            $route->setMethod($controller[1]);
        }

    return $isValidPath;

    }

    private function error404() {
        Renderer::getSmarty()->display('404.tpl');
        exit;
    }


}