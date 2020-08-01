<?php
if (Request::isPost()){

    $product = Product::getDataFromPost();
    $productId = Product::add($product);

//    var_dump("<pre>");
//    var_dump($_POST);
//    var_dump($_FILES);


    /*Загрузка файлов в папку товара*/
    $uploadImages = $_FILES['images'] ?? []; // проверяем есть ли файлы в форме

    $imageNames = $uploadImages['name'];  // забираем массив с именами файлов
    $imageTmpNames = $uploadImages['tmp_name']; // масств с временными путями к файлам


    $path = APP_UPLOAD_PRODUCTS_DIR . '/' . $productId; // формируем адрес пусти для файлов конкретного товара по его ID

    if(!file_exists($path)){
        mkdir($path);  // создаем папку с id товара если такой нет
    }

    for ($i = 0; $i < count($imageNames); $i++) {
        $imageName = basename($imageNames[$i]);  // обрезаем пути до имени файла если они есть
        $imageTmpName = $imageTmpNames[$i];

        $imagePath = $path . "/" . $imageName;

        move_uploaded_file($imageTmpName, $path . '/' . $imageName);  // перебрасываем файлы из временной папки формы в постоянную по id товара

        ProductImage::add([
            'product_id'=> $productId,
            'name'=>$imageName,
            'path'=>str_replace(APP_PUBLIC_DIR, '', $imagePath),
        ]);

    }
//
//    exit;




    if($productId){
        Response::redirect('/products/list');
    } else {
        die("Произошла ошибка с отправлением данных");
    }

}

$categories = Category::getList();

$smarty->assign("categories", $categories);
$smarty->display('products/add.tpl');
