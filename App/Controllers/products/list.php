<?php

$current_page = (int) ($_GET['p'] ?? 0);
$limit = 5; //товаро нв странице
$products_count = get_product_list_count($connect);


$offset = ($current_page - 1) * $limit; // смещение товаров у пагинации

if ($offset < 0 ) {
    $offset = 0;
}

$products = get_product_list($connect, $limit, $offset);
$pages_count = ceil($products_count / $limit); //количество страниц


$smarty->assign('page_count', $pages_count);
$smarty->assign('products', $products);
$smarty->display('products/index.tpl');
