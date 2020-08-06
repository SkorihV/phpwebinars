<?php
use App\Category;
use App\Product;
use App\ProductImage;
use App\Request;
use App\Response;

if (Request::isPost()){

    $product = Product::getDataFromPost();
    $productId = Product::add($product);

    /*Загрузка файлов в папку товара*/
    $uploadImages = $_FILES['images'] ?? []; // проверяем есть ли файлы в форме

    $imageNames = $uploadImages['name'];  // забираем массив с именами файлов
    $imageTmpNames = $uploadImages['tmp_name']; // масств с временными путями к файлам

    /*Загрузка изображений из УРЛ*/

    $imageURL = $_POST['image_url'] ?? '';
    ProductImage::uploadImagesByUrl($productId, $imageURL);


    /*Загрузка файлов в папку товара*/

    $uploadImages = $_FILES['images'] ?? []; // проверяем есть ли файлы в форме
    ProductImage::uploadImages($productId, $uploadImages);


    if($productId){
        Response::redirect('/products/list');
    } else {
        die("Произошла ошибка с отправлением данных");
    }

}

$categories = Category::getList();

$smarty->assign("categories", $categories);
$smarty->display('products/add.tpl');
