<?php
/*Показываем товары в рамках одной категории*/

use App\Category;
use App\Product;
use App\Request;

$category_id = Request::getIntFromGet("id");
$category = Category::getById($category_id);


$products = Product::getListByCategory( $category_id);
$smarty->assign("current_category", $category); //передаем в шаблон id текущей категории чтобы её подсветить в меню
$smarty->assign("products", $products);
$smarty->display("categories/view.tpl");