<?php
$host = '127.0.0.1';
$user = 'root';
$password = '';
$database = 'phpwebinars';

$connect = mysqli_connect($host, $user, $password, $database);

if (mysqli_connect_errno()){
    $error = mysqli_connect_error();
    exit;
}

$id = $_GET['id'] ?? 0;
$id = (int) $id;

$book = [];

if ($id) {
    $query = "SELECT * FROM books WHERE id = $id";
    $result = mysqli_query($connect, $query);
    $book = mysqli_fetch_assoc($result);

    if (is_null($book)) {
        $book = [];
    }
}

if (!empty($_POST)){
    $id = $_POST["id"] ?? 0;
    $name = $_POST["name"] ?? '';
    $year = $_POST["year"] ?? '';

    $query = "UPDATE books SET name = '$name', year = '$year' WHERE id = $id";
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
    <input type="hidden" name="id" value="<?php echo $book['id'] ?? 0; ?>">
    <label>
       Название книги: <input type="text" name="name" required value="<?php echo $book['name'] ?? ''; ?>">
    </label>
    <label>
        Год издания: <input type="number" name="year" required value="<?php echo $book['year'] ?? ''; ?>">
    </label>
    <input type="submit" value="Сохранить">
</form>