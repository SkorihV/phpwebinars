<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/../config/config.php";

$query = "SELECT * FROM products";
$connect = connect();
$result =  query($connect, $query);

$products = [];
while($row = mysqli_fetch_assoc($result)){
    $products[] = $row;
}


$smarty->assign('products', $products);
$smarty->display('products/index.tpl');
