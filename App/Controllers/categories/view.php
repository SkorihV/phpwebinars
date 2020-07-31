<?php
/*Показываем товары в рамках одной категории*/


$category_id = (int) ($_GET["id"] ?? 0);

$category = get_category_by_id($connect, $category_id);
$products = get_product_list_by_category($connect, $category_id);
$smarty->assign("current_category", $category); //передаем в шаблон id текущей категории чтобы её подсветить в меню
$smarty->assign("products", $products);
$smarty->display("categories/view.tpl");