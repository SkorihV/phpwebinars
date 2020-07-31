<?php
if (Request::isPost()){
    $product = Product::getDataFromPost();
    $inserted = Product::add($product);

    if($inserted){
        Response::redirect('/products/list');
    } else {
        die("Произошла ошибка с отправлением данных");
    }

}

$categories = Category::getList();

$smarty->assign("categories", $categories);
$smarty->display('products/add.tpl');
