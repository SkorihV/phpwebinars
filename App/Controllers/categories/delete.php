<?php
$id = $_POST['id'] ?? 0;
$id = (int) $id;
if (!$id) {
    die ("Ошибка идентификатора");
}

$deleted = Category::deleteById($id);


if($deleted){
    header('Location:/categories/list');
} else {
    die("Произошла ошибка с отправлением данных");
}


