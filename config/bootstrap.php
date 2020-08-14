<?php
use App\Category;
use App\Renderer;
use App\Router\Dispatcher;

require_once 'config.php';


$categories = Category::getList();
Renderer::getSmarty()->assign("categories", $categories);

$dispatcher = new Dispatcher();
$dispatcher->dispatch();
