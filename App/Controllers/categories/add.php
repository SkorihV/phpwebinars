<?php
if (!empty($_POST)){
    $category = Category::getDataFromPost();
    $inserted = Category::add($category);

    if($inserted){
        header('Location: /categories/list');
    } else {
        die("Произошла ошибка с отправлением данных");
    }

}

$smarty->display('categories/add.tpl');
