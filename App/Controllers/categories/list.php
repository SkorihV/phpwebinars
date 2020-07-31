<?php
$categories = get_category_list($connect);

$smarty->assign('categories', $categories);
$smarty->display('categories/index.tpl');
