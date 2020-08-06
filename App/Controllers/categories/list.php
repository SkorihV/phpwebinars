<?php
use App\Category;

$categories = Category::getList();

$smarty->assign('categories', $categories);
$smarty->display('categories/index.tpl');
