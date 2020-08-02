<?php
$productId = Request::getIntFromGet("id", false);

$product = [];

if ($productId) {
    $product = Product::getById($productId);
}

if (Request::isPost()){
    $productData = Product::getDataFromPost();
    $edited = Product::updateById( $productId, $productData);

    $path = APP_UPLOAD_PRODUCTS_DIR . '/' . $productId; // формируем адрес пусти для файлов конкретного товара по его ID

    if(!file_exists($path)){
        mkdir($path);  // создаем папку с id товара если такой нет
    }

    /*Загрузка изображений из УРЛ*/

    $imageURL = $_POST['image_url'] ?? '';

    if ($imageURL) {
        $imageContentType = [
            'image/png' => '.png',
            'image/bmp' => '.bmp',
            'image/gif' => '.gif',
            'image/x-icon' => '.ico',
            'image/jpeg' => '.jpg',
            'image/svg+xml' => '.svg',
            'image/tiff' => '.tiff',
            'image/webp' => '.webp',
        ];

        $imagePath = $path . '/';
        $headers = get_headers($imageURL);

        $contentType = null;

        foreach ($headers as $headerStr) {
            if (strpos(strtolower($headerStr), 'content-type') === false) {
                continue;
            }

            $header = explode(':', $headerStr);
            $contentType = trim(strtolower($header[1] ?? ''));
        }

        $imageExt = $imageContentType[$contentType] ?? null;

        if (!is_null($imageExt)) {
            $productImageId = ProductImage::add([
                'product_id' => $productId,
                'name' => '',
                'path' => '',
            ]);
            $filename = $productId . "_" . $productImageId . "_upload" . time() . $imageExt;
            $imagePath = $path . "/" . $filename;

            file_put_contents($imagePath, fopen($imageURL, 'r'));

            ProductImage::updateById($productImageId, [
                'name' => $filename,
                'path' => str_replace(APP_PUBLIC_DIR, '', $imagePath),
            ]);
        }
    }

    /*Загрузка файлов в папку товара*/
    $uploadImages = $_FILES['images'] ?? []; // проверяем есть ли файлы в форме

    if($uploadImages) {

        $imageNames = $uploadImages['name'];  // забираем массив с именами файлов
        $imageTmpNames = $uploadImages['tmp_name']; // масств с временными путями к файлам

//    $currentImageNames = [];
//
//    foreach ($product['images'] as $image) {
//        $currentImageNames[] = $image['name'];
//    }
//
//    $diffFileNames = array_diff($imageNames, $currentImageNames);


        for ($i = 0; $i < count($imageNames); $i++) {
            $imageName = basename($imageNames[$i]);  // обрезаем пути до имени файла если они есть
            $imageTmpName = $imageTmpNames[$i];

            $filename = $imageName;
            $counter = 0;

            while (true) {
                $duplicateImage = ProductImage::findByFileNameInProduct($productId, $filename);
                if (empty($duplicateImage)) {
                    break;
                }

                $info = pathinfo($imageName);
                $filename = $info['filename'];
                $filename .= '_' . $counter . '.' . $info['extension'];
                $counter++;

            }

            $imagePath = $path . "/" . $filename;

            move_uploaded_file($imageTmpName, $imagePath);  // перебрасываем файлы из временной папки формы в постоянную по id товара


            ProductImage::add([
                'product_id' => $productId,
                'name' => $filename,
                'path' => str_replace(APP_PUBLIC_DIR, '', $imagePath),
            ]);
        }
    }

    /*конец загрузки изображений*/

        Response::redirect('/products/list');
}
$categories = Category::getList();

$smarty->assign("categories", $categories);

$smarty->assign("product", $product);
$smarty->display("products/edit.tpl");
