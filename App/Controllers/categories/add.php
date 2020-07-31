<?php
if (Request::isPost()){
    $category = Category::getDataFromPost();
    $inserted = Category::add($category);

    if($inserted){
        Response::redirect('/categories/list');
    } else {
        die("Произошла ошибка с отправлением данных");
    }

}

$smarty->display('categories/add.tpl');
