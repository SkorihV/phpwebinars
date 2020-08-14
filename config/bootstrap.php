<?php
use App\Category;
use App\Product\ProductController;
use App\Renderer;
use App\Router\Dispatcher;

require_once 'config.php';

//$requestUri = $_SERVER['REQUEST_URI'];
//$requestUri = explode('?', $requestUri);
//$requestUri = $requestUri[0];
//
//$url = $requestUri ?? '/';



$categories = Category::getList();
Renderer::getSmarty()->assign("categories", $categories);

$dispatcher = new Dispatcher();
$dispatcher->dispatch();

//$routers = [
//    '/products/list' => [ ProductController::class, 'list'],
//    '/products/edit' => [ ProductController::class, 'edit'],
//    '/products/add' => [ ProductController::class, 'add'],
//];



//$route = null;
//
//foreach ($routers as $path => $controller) {
//    if ($url == $path) {
//        $route = $controller;
//        break;
//    }
//}
//
//if (is_null($route)) {
//    Renderer::getSmarty()->display('404.tpl');
//    exit;
//}
//
//
//$class = $route[0];
//$method = $route[1];
//
//$controller = new $class();
//
//if (method_exists($controller, $method)) {
//    $controller->{$method}();
//} else {
//    Renderer::getSmarty()->display('404.tpl');
//    exit;
//}



//$controller = new ProductController();
//$controller->list();



//$is_index = substr($url, -1) == '/';
//if($is_index){
//    $url .= "/index";
//}
//
//$controller_path = $_SERVER['DOCUMENT_ROOT'] . '/../App/Controllers' . $url . '.php';

//if(file_exists($controller_path)){
//    require_once $controller_path;
//} else {
//    $smarty->display('404.tpl');
//}
