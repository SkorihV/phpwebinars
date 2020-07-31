<?php
$id = Request::getIntFromPost("id", false);
if (!$id) {
    die ("Ошибка идентификатора");
}

$deleted = Product::deleteById($id);


if($deleted){
    Response::redirect('/products/list');
} else {
    die("Произошла ошибка с отправлением данных");
}


