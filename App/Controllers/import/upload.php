<?php

//$file = $_FILES['import_file'] ?? null;
//
//if (is_null($file) || empty($file['name'])) {
//    die("файл импорта не загружен");
//}
//
//$uploadDir = APP_PUBLIC_DIR . "/import";
//
//if (!file_exists($uploadDir)) {
//    mkdir($uploadDir);
//}
//
//$importFileName = 'i_' . time() . '.' . $file['name'];
//move_uploaded_file($file['tmp_name'], $uploadDir . '/' . $importFileName);

$fileName = 'i_1596515988.import 1.csv';
$filePath = APP_PUBLIC_DIR . '/' . 'import' . $fileName;

$taskName = 'Импорт товаров ' . $fileName;
$task = 'Import::productFromFileTask';
$taskParams = [
    'fileName' => $fileName
];

$taskId = TasksQueue::addTask($taskName, $task, $taskParams);

Response::redirect('/queue/list');

exit;

$file = fopen($filePath, 'r');

$withHeader = true;
$settings = [
    0 => 'name',
    1 => 'category_name',
    2 => 'article',
    3 => 'price',
    4 => 'amount',
    5 => 'description',
    6 => 'image_urls',
];

$mainField = 'article';

if ($withHeader) {
    $headers = fgetcsv($file, 10000, ';');
}
while ($row = fgetcsv($file, 10000, ';')) {
    $productData = [];

    foreach ($settings as $index => $key) {
        $productData[$key] = $row[$index] ?? null;
    }

    $product = [
        'name' => Db::escape($productData['name']),
        'article' => Db::escape($productData['article']),
        'price' => Db::escape($productData['price']),
        'amount' => Db::escape($productData['amount']),
        'description' => Db::escape($productData['description']),
    ];

    $categoryName = $productData['category_name'];



    $category = Category::getByName($categoryName);
    if (empty($category)) {
//        continue;
        $categoryId = Category::add([
            'name' => $categoryName
        ]);
    }else{
        $categoryId = $category['id'];
    }

    $product['category_id'] = $categoryId;

    $targetProduct = Product::getByField($mainField, $product[$mainField]);
    if (empty($targetProduct)) {
    $productId = Product::add($product);
    } else {
        $productId = $targetProduct['id'];
        $targetProduct = array_merge($targetProduct, $product);
     Product::updateById($productId, $targetProduct);
    }


    $productData['image_urls'] = explode("\n", $productData['image_urls']);
    $productData['image_urls'] = array_map(function ($item){
        return trim($item);
    },$productData['image_urls']);
    $productData['image_urls'] = array_filter($productData['image_urls'], function ($item){
        return !empty($item);
    });

    foreach ($productData['image_urls'] as $imageUrl) {
        ProductImage::uploadImagesByUrl($productId, $imageUrl );
    }
}

Response::redirect('/products/list');




