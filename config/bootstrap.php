<?php
use App\Category;

require_once 'config.php';

$requestUri = $_SERVER['REQUEST_URI'];
$requestUri = explode('?', $requestUri);
$requestUri = $requestUri[0];

if($requestUri == "/"){
    $requestUri = "/index";
}

$categories = Category::getList();
$smarty->assign("categories", $categories);

$controller_path = $_SERVER['DOCUMENT_ROOT'] . '/../App/Controllers' . $requestUri . '.php';


if(file_exists($controller_path)){
    require_once $controller_path;
} else {
    $smarty->display('404.tpl');
}
