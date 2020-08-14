<?php
use App\Category;
use App\Product;
use App\ProductImage;
use App\Request;
use App\Response;


if (Request::isPost()){

    $productData = Product::getDataFromPost();

    $productRepository = new Product\ProductRepository($productData);
    $product = $productRepository->getProductFromArray($productData);

    $product = $productRepository->save($product);


    $productId = $product->getId();



    /*Загрузка изображений из УРЛ*/


    $imageURL = trim($_POST['image_url'] ?? '');
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


$product = new Product\ProductModel("", 0, 0);
$product->setCategory(new Category\CategoryModel(''));

$categories = Category::getList();

$smarty->assign("categories", $categories);

$smarty->assign("product", $product);
$smarty->display('products/add.tpl');
