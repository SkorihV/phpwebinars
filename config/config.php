<?php
require_once __DIR__ . "/../libs/Smarty/Smarty.class.php";
require_once __DIR__ . "/../App/Product.php";
require_once __DIR__ . "/../App/Category.php";
require_once __DIR__ . "/../App/Db.php";
require_once __DIR__ . "/../App/Request.php";
require_once __DIR__ . "/../App/Response.php";
$smarty = new Smarty();


$smarty->template_dir = __DIR__ . '/../templates';
$smarty->compile_dir = __DIR__ . '/../var/compile';
$smarty->config_dir = __DIR__ . '/../var/configs';
$smarty->cache_dir = __DIR__ . '/../var/cache';

/*
function connect($host = '127.0.0.1', $user = 'root', $password = '', $database = 'phpwebinars') {
    $connect = mysqli_connect($host, $user, $password, $database);
    if (mysqli_connect_errno()){
        $error = mysqli_connect_error();
        exit;
    }
    return $connect;
}

$connect = connect();

function query($connect, $query) {
    $result = mysqli_query($connect, $query);

    if (mysqli_errno($connect)){
        $error = mysqli_error($connect);
        echo $error;
        exit;
    }
    return  $result;
}*/