<?php
require_once "config.php";

$id = $_POST['id'] ?? 0;
$id = (int) $id;
if (!$id) {
    die ("Ошибка идентификатора");
}


$connect = connect();

$query = "DELETE FROM products WHERE id = $id";
$result = query($connect, $query);

if(mysqli_affected_rows($connect)){
    header('Location:/');
} else {
    die("Произошла ошибка с отправлением данных");
}


