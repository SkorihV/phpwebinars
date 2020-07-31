<?php
$id = $_GET['id'] ?? 0;
$id = (int) $id;

$category = [];

if ($id) {
    $category = Category::getById($id);
}

if (!empty($_POST)){
    $category = Category::getDataFromPost();
    $edited = Category::updateById($id, $category);


    if($edited){
        header('Location:/categories/list');
    } else {
        die("Произошла ошибка с отправлением данных");
    }
}

$smarty->assign("category", $category);
$smarty->display("categories/edit.tpl");
