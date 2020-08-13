<?php

use App\Product;
use App\Request;

$current_page = Request::getIntFromGet("p", 1);
$limit = 10; //товаро нв странице
$products_count = Product::getListCount();


$offset = ($current_page - 1) * $limit; // смещение товаров у пагинации
$pages_count = ceil($products_count / $limit); //количество страниц


$productRepository = new Product\ProductRepository();
$products = $productRepository->getList($limit, $offset);



//$products = Product::getList( $limit, $offset);


$smarty->assign('page_count', $pages_count);
$smarty->assign('products', $products);
$smarty->display('products/index.tpl');
