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


$query = "SELECT * FROM books";
$result = mysqli_query($connect, $query);

if (mysqli_errno($connect)){
    $error = mysqli_error($connect);
    exit;
}

echo "<a href='/add.php'>Добавить</a>";

echo "<table border='1px' cellpadding='5px'>";
$drowhead = true;
while ($row = mysqli_fetch_assoc($result)) {
    if ($drowhead) {
        echo "<tr>";
            foreach ($row as $field => $value) {
                echo "<td>";
                echo "$field";
                echo "</td>";
            }
            echo "<td>";
            echo "</td>";
            $drowhead = false;
        echo "</tr>";
    }
    echo "<tr>";
        foreach ($row as $field => $value) {
            echo "<td>";
            echo "$value";
            echo "</td>";
        }
        echo "<td>";
        $id = $row['id'];

        echo '<form action="/delete.php" method="post" style="display: inline"><input type="hidden" name="id" value="'. $id .'"><input type="submit" value="Удал"></form>';
        echo "&nbsp;&nbsp;&nbsp;||&nbsp;&nbsp;&nbsp;";
        echo "<a href='/edit.php?id=$id'>Ред</a>";
        echo "</td>";
   echo "</tr>";
}

echo "</table>";
