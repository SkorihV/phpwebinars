<?php
use App\Data\CategoryService;
use App\DI\Container;
use App\Kernel;
use App\Router\Dispatcher;

//require_once '/config.php';
require_once __DIR__ . "/../vendor/autoload.php";

//require_once __DIR__ . '/../config/config.php';

define('APP_DIR', realpath(__DIR__ . '/../'));
define('APP_PUBLIC_DIR', APP_DIR . '/public');
define('APP_UPLOAD_DIR', APP_PUBLIC_DIR . '/upload');
define('APP_UPLOAD_PRODUCTS_DIR', APP_UPLOAD_DIR . '/products');


(new Kernel())->run();


//
//if(!file_exists(APP_UPLOAD_DIR)){
//    mkdir(APP_UPLOAD_DIR);
//}
//
//if(!file_exists(APP_UPLOAD_PRODUCTS_DIR)){
//    mkdir(APP_UPLOAD_PRODUCTS_DIR);
//}
//
//
//
//function deleteDir($dir) {
//    $files = array_diff(scandir($dir), array('.','..')); // получаем список вложенных файлов и папок
//
//    // обрабатываем весь список рекурсивной функцией и удаляем содержимое папок
//    foreach ($files as $file) {
//        (is_dir("$dir/$file")) ? deleteDir("$dir/$file") : unlink("$dir/$file");
//    }
//    return rmdir($dir);
//
//}
//
//
//
//$di = new Container();
//
//$di->singletone(Smarty::class, function (){
//    $smarty = new Smarty();
//
//    $smarty->template_dir = APP_DIR . '/templates';
//    $smarty->compile_dir = APP_DIR . '/var/compile';
//    $smarty->config_dir = APP_DIR . '/var/configs';
//    $smarty->cache_dir = APP_DIR . '/var/cache';
//
//    return $smarty;
//});
//
//$smarty = $di->get(Smarty::class);
//
//$categoryService = new CategoryService();
//$categories = $categoryService->getList();
//$smarty->assign("categories", $categories);
//
//$dispatcher = new Dispatcher($di);
//$dispatcher->dispatch();


