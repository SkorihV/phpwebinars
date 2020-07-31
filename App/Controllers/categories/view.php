<?php
/*Показываем товары в рамках одной категории*/

$category_id = Request::getIntFromGet("id");
$category = Category::getById($category_id);


$products = Product::getListByCategory( $category_id);
$smarty->assign("current_category", $category); //передаем в шаблон id текущей категории чтобы её подсветить в меню
$smarty->assign("products", $products);
$smarty->display("categories/view.tpl");