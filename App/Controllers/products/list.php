<?php
$products = get_product_list($connect);

$smarty->assign('products', $products);
$smarty->display('products/index.tpl');
