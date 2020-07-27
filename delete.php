<?php
$id = $_POST['id'] ?? 0;
$id = (int) $id;
if (!$id) {
    die ("Ошибка идентификатора");
}

$host = '127.0.0.1';
$user = 'root';
$password = '';
$database = 'phpwebinars';

$connect = mysqli_connect($host, $user, $password, $database);

if (mysqli_connect_errno()){
    $error = mysqli_connect_error();
    exit;
}

$query = "DELETE FROM books WHERE id = $id";
$result = mysqli_query($connect, $query);

if (mysqli_errno($connect)){
    var_dump(mysqli_error($connect));
    exit;
}

if(mysqli_affected_rows($connect)){
    header('Location:/');
} else {
    die("Произошла ошибка с отправлением данных");
}


