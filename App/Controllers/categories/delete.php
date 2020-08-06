<?php
use App\Category;
use App\Request;
use App\Response;

$category_id = Request::getIntFromPost("id");
if (!$category_id) {
    die ("Ошибка идентификатора");
}

$deleted = Category::deleteById($category_id);

if($deleted){
    Response::redirect('/categories/list');
} else {
    die("Произошла ошибка с отправлением данных");
}


