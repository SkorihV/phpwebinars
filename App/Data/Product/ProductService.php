<?php

namespace App\Data\Product;

use App\Db\Db;
use App\Http\Request;
use App\Data\ProductImageService;

class ProductService {
    public  function getListCount() {
        $query = "SELECT COUNT(1) as c FROM products p LEFT JOIN categories c ON p.category_id = c.id";
        return Db::fetchOne($query);
    }

    public  function getList($limit = 100, $offset = 0){
        $query = "SELECT p.*, c.name as category_name FROM products p LEFT JOIN categories c ON p.category_id = c.id LIMIT $offset, $limit";
        $products = Db::fetchAll($query);

        foreach ($products as &$product) {
            $product['images'] = ProductImage::getListByProductId($product['id']);

        }

        return $products;
    }

    public  function getListByCategory($category_id){
        $query = "SELECT p.*, c.name as category_name FROM products p LEFT JOIN categories c ON p.category_id = c.id WHERE p.category_id = $category_id";

        return Db::fetchAll($query);
    }

    public  function getById($id){
        $query = "SELECT p.*, c.id AS category_id FROM products p LEFT JOIN categories c ON p.category_id = c.id WHERE p.id = $id";
        $product =  Db::fetchRow($query);

        $product['images'] = ProductService::getListByProductId($id);

        return $product;

    }

    public  function updateById(int $id, array $product):int
    {
        return Db::update("products", $product, "id = $id");
    }

    public  function add(array $product): int
    {

        if (isset($product["id"])){
            unset($product["id"]);
        }
        return Db::insert("products", $product);
    }
    public  function deleteById(int $id){

        $path = APP_UPLOAD_PRODUCTS_DIR . '/' . $id;
       if(file_exists($path)) {
           deleteDir($path);  // удаляем картинки при удалении товара
       }

        ProductService::deleteByProductId($id);

       return Db::delete('products', "id = $id");
    }

    public  function getDataFromPost(Request $request){
        return [
            'id'            => $request->getIntFromPost("id", false),
            'name'          => $request->getStrFromPost("name"),
            'article'       => $request->getStrFromPost("article"),
            'price'         => $request->getIntFromPost("price"),
            'amount'        => $request->getIntFromPost("amount"),
            'description'   => $request->getStrFromPost("description"),
            'category_id'   => $request->getIntFromPost("category_id"),
        ];
    }

    public  function getByField(string $mainField, string $value)
    {
        $mainField = Db::escape($mainField);
        $value = Db::escape($value);

        $query = "SELECT * FROM products WHERE `$mainField` = '$value'";
        return Db::fetchRow($query);

    }
}
