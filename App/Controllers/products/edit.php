<?php
$productId = Request::getIntFromGet("id", false);

$product = [];

if ($productId) {
    $product = Product::getById($productId);
}

if (Request::isPost()){
    $productData = Product::getDataFromPost();
    $edited = Product::updateById( $productId, $productData);


    /*Загрузка файлов в папку товара*/
    $uploadImages = $_FILES['images'] ?? []; // проверяем есть ли файлы в форме

    $imageNames = $uploadImages['name'];  // забираем массив с именами файлов
    $imageTmpNames = $uploadImages['tmp_name']; // масств с временными путями к файлам

    $currentImageNames = [];

    foreach ($product['images'] as $image) {
        $currentImageNames[] = $image['name'];
    }

    $diffFileNames = array_diff($imageNames, $currentImageNames);

    $path = APP_UPLOAD_PRODUCTS_DIR . '/' . $productId; // формируем адрес пусти для файлов конкретного товара по его ID

    if(!file_exists($path)){
        mkdir($path);  // создаем папку с id товара если такой нет
    }

    for ($i = 0; $i < count($imageNames); $i++) {
        $imageName = basename($imageNames[$i]);  // обрезаем пути до имени файла если они есть
        $imageTmpName = $imageTmpNames[$i];

        $imagePath = $path . "/" . $imageName;

        move_uploaded_file($imageTmpName, $path . '/' . $imageName);  // перебрасываем файлы из временной папки формы в постоянную по id товара

        if(in_array($imageName, $diffFileNames) && $imageName){
            ProductImage::add([
                'product_id'=> $productId,
                'name'=>$imageName,
                'path'=>str_replace(APP_PUBLIC_DIR, '', $imagePath),
            ]);
        }

    }

        Response::redirect('/products/list');
}
$categories = Category::getList();

$smarty->assign("categories", $categories);

$smarty->assign("product", $product);
$smarty->display("products/edit.tpl");
