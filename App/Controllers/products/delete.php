<?php
$id = $_POST['id'] ?? 0;
$id = (int) $id;
if (!$id) {
    die ("Ошибка идентификатора");
}

$deleted = delete_product_by_id($connect, $id);


if($deleted){
    header('Location:/products/list');
} else {
    die("Произошла ошибка с отправлением данных");
}


