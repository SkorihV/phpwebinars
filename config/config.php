<?php
require_once __DIR__ . "/../libs/Smarty/Smarty.class.php";
spl_autoload_register(function($name){

    $name = str_replace('\\', '/', $name);
    $filepath = __DIR__ . '/../' . $name . '.php';

    if(file_exists($filepath)) {
        require_once $filepath;
    }
});

define('APP_DIR', realpath(__DIR__ . '/../'));
define('APP_PUBLIC_DIR', APP_DIR . '/public');
define('APP_UPLOAD_DIR', APP_PUBLIC_DIR . '/upload');
define('APP_UPLOAD_PRODUCTS_DIR', APP_UPLOAD_DIR . '/products');

if(!file_exists(APP_UPLOAD_DIR)){
    mkdir(APP_UPLOAD_DIR);
}

if(!file_exists(APP_UPLOAD_PRODUCTS_DIR)){
    mkdir(APP_UPLOAD_PRODUCTS_DIR);
}



$smarty = new Smarty();

$smarty->template_dir = __DIR__ . '/../templates';
$smarty->compile_dir = __DIR__ . '/../var/compile';
$smarty->config_dir = __DIR__ . '/../var/configs';
$smarty->cache_dir = __DIR__ . '/../var/cache';


function deleteDir($dir) {
    $files = array_diff(scandir($dir), array('.','..')); // получаем список вложенных файлов и папок

    // обрабатываем весь список рекурсивной функцией и удаляем содержимое папок
    foreach ($files as $file) {
        (is_dir("$dir/$file")) ? deleteDir("$dir/$file") : unlink("$dir/$file");
    }
    return rmdir($dir);

}


