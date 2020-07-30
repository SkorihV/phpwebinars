<?php
$id = $_GET['id'] ?? 0;
$id = (int) $id;

$product = [];

if ($id) {
    $product = get_product_by_id($connect,$id);
}

if (!empty($_POST)){
    $product = get_product_from_post();
    $edited = update_product_by_id($connect, $id, $product);


    if($edited){
        header('Location:/products/list');
    } else {
        die("Произошла ошибка с отправлением данных");
    }
}
$categories = get_category_list($connect);

$smarty->assign("categories", $categories);

$smarty->assign("product", $product);
$smarty->display("products/edit.tpl");
