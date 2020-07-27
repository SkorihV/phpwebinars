<?php
if (!empty($_POST)){
    $name = $_POST["name"] ?? '';
    $year = $_POST["year"] ?? '';

    $host = '127.0.0.1';
    $user = 'root';
    $password = '';
    $database = 'phpwebinars';

    $connect = mysqli_connect($host, $user, $password, $database);

    if (mysqli_connect_errno()){
        $error = mysqli_connect_error();
        exit;
    }

    $query = "INSERT INTO books (name, year) VALUES ('$name', '$year')";
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
}
?>
<br>
<br>
<form method="post">
    <label>
       Название книги: <input type="text" name="name" required>
    </label>
    <label>
        Год издания: <input type="number" name="year" required>
    </label>
    <input type="submit" value="Добавить">
</form>