<?php
namespace App\Router;

use App\Category\CategoryController;
use App\DI\Container;
use App\Product\ProductController;
use App\Queue\QueueController;
use App\Import\ImportController;
use App\Renderer;
use App\Request;
use App\Router\Exception\MethodDoesNotExistException;
use App\Router\Exception\NotFoundException;

use ReflectionObject;
use Smarty;

/**
 * Created by PhpStorm.
 * User: vitaliy.skoryh
 * Date: 14.08.20
 * Time: 11:10
 */
class Dispatcher
{
    /**
     * @var Container
     */
    private $di;

    public function __construct(Container $di)
    {
        $this->di = $di;
    }

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

    protected function getRouts():array
    {
        $routes = $this->routes;

//        $controllerFile = APP_DIR . '/App/Product/ProductController.php';

        $files = $this->scanDir(APP_DIR . '/App');

        foreach ($files as $filePath) {
            if(strpos($filePath, 'Controller.php') === false) {
                continue;
            }

            $controllerRoutes = $this->getRoutesByControllerFile($filePath);
            $routes = array_merge($routes, $controllerRoutes);
        }


        return $routes;
    }

    /**
     * @param string $dirName
     * @return array
     */
    protected function scanDir(string $dirName) {
        $list = scandir($dirName);

        $list = array_filter($list, function($item){
            return !in_array($item, ['.','..']);
        });

        $fileNames = [];

        foreach ($list as $fileItem) {
            $filePath = $dirName . '/' . $fileItem;
            if (!is_dir($filePath)) {
                $fileNames[] = $filePath;
            } else {
                $fileNames = array_merge($fileNames, $this->scanDir($filePath));
            }
        }

        return $fileNames;
    }

    /**
     * @return mixed|null
     * @throws MethodDoesNotExistException
     */
    public function dispatch()
    {
        $url = Request::getUrl();
        $route = new Route($url);

        foreach ($this->getRouts() as $path => $controller) {
            if ($this->isValidPath($path, $route)){
                break;
            }
        }

        try {

            $controllerClass = $route->getController();

            if(is_null($controllerClass)) {
                throw new NotFoundException();
            }

            $di = $this->getDi();

            $controller = $di->get($controllerClass, [
                Route::class => $route,
            ]);

//            $renderer = $di->get(Renderer::class);
//            $di->setProperty($controller, 'renderer', $renderer);
//            $di->setProperty($controller, 'route', $route);

            $controllerMethod = $route->getMethod();

            if (method_exists($controller, $controllerMethod)) {
                return $di->call($controller, $controllerMethod);
            }
            throw new MethodDoesNotExistException();

  //          $route->execute();
            // Выдает ошибку на |
//   } catch (NotFoundException | MethodDoesNotExistException $e) {
        } catch (NotFoundException $e) {
            $this->error404();
        }

    }

    public function isValidPath(string $path, Route $route) {

        $routes = $this->getRouts();
        $controller = $routes[$path];

        $isValidPath = $route->isValidPath($path);

        if ($isValidPath) {
            $route->setController($controller[0]);
            $route->setMethod($controller[1]);
        }

    return $isValidPath;
    }

    private function error404()
    {
        Renderer::getSmarty()->display('404.tpl');
        exit;
    }

    private function getRoutesByControllerFile(string $filePath)
    {

        $routes = [];

        $controllerClassName = str_replace([APP_DIR . '/', '.php'], '', $filePath);
        $controllerClassName = str_replace('/', '\\', $controllerClassName);

        $reflectionClass = new \ReflectionClass($controllerClassName);
        $reflectionMethods = $reflectionClass->getMethods(\ReflectionMethod::IS_PUBLIC);

//        $routes = [];

        foreach ($reflectionMethods as $reflectionMethod){

            if ($reflectionMethod->isConstructor()) {
                continue;
            }

            $docCommentArray = $this->getDi()->parseDocComment($reflectionMethod);

//            $docComment = (string)$reflectionMethod->getDocComment();
//            $docComment = str_replace(['/**', '*/'], '', $docComment);
//            $docComment = trim($docComment);
//            $docCommentArray = explode("\n", $docComment);
//
//            $docCommentArray = array_map(function($item){
//                $item = trim($item);
//
//                $position = strpos($item, '*');
//                if($position === 0){
//                    $item = substr($item, 1);
//                }
//
//                return trim($item);
//            }, $docCommentArray);

            foreach ($docCommentArray as $docString) {

                $isRoute = strpos($docString, '@route(') === 0;
                if (empty($docString) || !$isRoute){
                    continue;
                }

                $url = str_replace(['@route("', '")'], '', $docString);
                $routes[$url] = [$controllerClassName, $reflectionMethod->getName()];

            }
        }
        return $routes;
    }

    /**
     * @return Container
     */
    public function getDi()
    {
        return $this->di;
    }

}