<?php
use App\Category;
use App\Product;
use App\ProductImage;
use App\Request;
use App\Response;

$productId = Request::getIntFromGet("id", false);



$product = [];

if ($productId) {
    $product = Product::getById($productId);
}



if (Request::isPost()){
    $productData = Product::getDataFromPost();
    $edited = Product::updateById( $productId, $productData);

    /*Загрузка изображений из УРЛ*/

    $imageURL = $_POST['image_url'] ?? '';
    ProductImage::uploadImagesByUrl($productId, $imageURL);


    /*Загрузка файлов в папку товара*/

    $uploadImages = $_FILES['images'] ?? []; // проверяем есть ли файлы в форме
    ProductImage::uploadImages($productId, $uploadImages);

    /*конец загрузки изображений*/

        Response::redirect('/products/list');
}
$categories = Category::getList();

$smarty->assign("categories", $categories);

$smarty->assign("product", $product);
$smarty->display("products/edit.tpl");
