<?php

namespace App;

use App\Db\Db;

class Import
{
    public static function productFromFileTask(array $params) {

        $fileName = $params['fileName'] ?? null;


        if (is_null($fileName)) {
            return false;
        }


        $filePath = APP_PUBLIC_DIR . '/' . 'import/' . $fileName;

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
            $headers = fgetcsv($file);
        }


        while ($row = fgetcsv($file)) {
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



            $category = CategoryService::getByName($categoryName);
            if (empty($category)) {
//        continue;
                $categoryId = CategoryService::add([
                    'name' => $categoryName
                ]);
            }else{
                $categoryId = $category['id'];
            }

            $product['category_id'] = $categoryId;

            $targetProduct = ProductImageService::getByField($mainField, $product[$mainField]);
            if (empty($targetProduct)) {
                $productId = ProductImageService::add($product);
            } else {
                $productId = $targetProduct['id'];
                $targetProduct = array_merge($targetProduct, $product);
                ProductImageService::updateById($productId, $targetProduct);
            }


            $productData['image_urls'] = explode("\n", $productData['image_urls']);
            $productData['image_urls'] = array_map(function ($item){
                return trim($item);
            },$productData['image_urls']);
            $productData['image_urls'] = array_filter($productData['image_urls'], function ($item){
                return !empty($item);
            });

            foreach ($productData['image_urls'] as $imageUrl) {
                ProductImageService::uploadImagesByUrl($productId, $imageUrl );
            }
        }
        return true;
    }
}