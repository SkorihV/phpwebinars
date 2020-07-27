<?php
require_once "libs/Smarty/Smarty.class.php";

$smarty = new Smarty();

$smarty->template_dir = __DIR__ . '/templates';
$smarty->compile_dir = __DIR__ . '/var/compile';
$smarty->config_dir = __DIR__ . '/var/configs';
$smarty->cache_dir = __DIR__ . '/var/cache';

function connect($host = '127.0.0.1', $user = 'root', $password = '', $database = 'phpwebinars') {
    $connect = mysqli_connect($host, $user, $password, $database);

    if (mysqli_connect_errno()){
        $error = mysqli_connect_error();
        exit;
    }
    return $connect;
}

function query($connect, $query) {
    $result = mysqli_query($connect, $query);

    if (mysqli_errno($connect)){
        $error = mysqli_error($connect);
        exit;
    }
    return  $result;
}