<?php
use App\Category;
use App\Product;
use App\ProductImage;
use App\Request;
use App\Response;

$productId = Request::getIntFromGet("id", false);


$product = [];

$productRepository = new Product\ProductRepository();

if ($productId) {
    $product = $productRepository->getById($productId);
}


if (Request::isPost()){
    $productData = Product::getDataFromPost();

    $product->setName($productData['name']);
    $product->setArticle($productData['article']);
    $product->setDescription($productData['description']);
    $product->setAmount($productData['amount']);
    $product->setPrice($productData['price']);


    $categoryId = $productData['category_id'] ?? 0;

    if ($categoryId) {
        $categoryData = \App\Category::getById($categoryId);
        $categoryName = $categoryData['name'];
        $category = new \App\Category\CategoryModel($categoryName);
        $category->setId($categoryId);

        $product->setCategory($category);
    }

    $product = $productRepository->save($product);


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
