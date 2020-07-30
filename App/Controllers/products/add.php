<?php
if (!empty($_POST)){
    $product = get_product_from_post();
    $inserted = add_product($connect, $product);

    if($inserted){
        header('Location: /products/list');
    } else {
        die("Произошла ошибка с отправлением данных");
    }

}

$categories = get_category_list($connect);

$smarty->assign("categories", $categories);
$smarty->display('products/add.tpl');
