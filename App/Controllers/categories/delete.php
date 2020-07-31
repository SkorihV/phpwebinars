<?php
$id = Request::getIntFromPost("id");
if (!$id) {
    die ("Ошибка идентификатора");
}

$deleted = Category::deleteById($id);

if($deleted){
    Response::redirect('/categories/list');
} else {
    die("Произошла ошибка с отправлением данных");
}


