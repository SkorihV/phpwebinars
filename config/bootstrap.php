<?php
use App\CategoryService;
use App\DI\Container;
use App\Router\Dispatcher;

require_once 'config.php';





$di = new Container();

$di->singletone(Smarty::class, function (){
    $smarty = new Smarty();

    $smarty->template_dir = APP_DIR . '/templates';
    $smarty->compile_dir = APP_DIR . '/var/compile';
    $smarty->config_dir = APP_DIR . '/var/configs';
    $smarty->cache_dir = APP_DIR . '/var/cache';

    return $smarty;
});

$smarty = $di->get(Smarty::class);

$categoryService = new CategoryService();
$categories = $categoryService->getList();
$smarty->assign("categories", $categories);

$dispatcher = new Dispatcher($di);
$dispatcher->dispatch();
