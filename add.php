<?php
require_once "config.php";
if (!empty($_POST)){
    $name = $_POST["name"] ?? '';
    $article = $_POST["article"] ?? '';
    $price = $_POST["price"] ?? '';
    $amount = $_POST["amount"] ?? '';
    $description = $_POST["description"] ?? '';



    $query = "INSERT INTO products (`name`, `article`, `price`, `amount`, `description`) VALUES ('$name', '$article', '$price', '$amount', '$description')";
    $connect = connect();
    $result = query($connect, $query);

    if(mysqli_affected_rows($connect)){
        header('Location: /');
    } else {
        die("Произошла ошибка с отправлением данных");
    }

}
$smarty->display('products/add.tpl');

