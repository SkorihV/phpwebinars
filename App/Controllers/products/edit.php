<?php
$id = $_GET['id'] ?? 0;
$id = (int) $id;

$product = [];

if ($id) {
    $product = Product::getById($id);
}

if (!empty($_POST)){
    $product = Product::getDataFromPost();
    $edited = Product::updateById( $id, $product);


    if($edited){
        header('Location:/products/list');
    } else {
        die("Произошла ошибка с отправлением данных");
    }
}
$categories = Category::getList();

$smarty->assign("categories", $categories);

$smarty->assign("product", $product);
$smarty->display("products/edit.tpl");
