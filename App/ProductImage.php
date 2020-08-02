<?php
class ProductImage {


    public static function getById(int $id){
        $query = "SELECT *  FROM products_images  WHERE id = $id";

        return Db::fetchRow($query);
    }

    public static function findByFileNameInProduct(int $productId, string $filename)
    {
        $query = "SELECT *  FROM products_images  WHERE product_id = $productId AND name = '$filename'";

        return Db::fetchRow($query);
    }

    public static function updateById(int $id, array $productImage):int
    {
        if (isset($productImage["id"])){
            unset($productImage["id"]);
        }
        return Db::update("products_images", $productImage, "id = $id");
    }

    public static function add(array $productImage): int
    {

        if (isset($productImage["id"])){
            unset($productImage["id"]);
        }
        return Db::insert("products_images", $productImage);
    }
    public static function deleteById(int $id){
       return Db::delete('products_images', "id = $id");
    }

//    public static function getDataFromPost(){
//        return [
//            'id' => Request::getIntFromPost("id", false),
//            'name' => Request::getStrFromPost("name"),
//            'article'=> Request::getStrFromPost("article"),
//            'price'=> Request::getIntFromPost("price"),
//            'amount'=> Request::getIntFromPost("amount"),
//            'description'=> Request::getStrFromPost("description"),
//            'category_id' => Request::getIntFromPost("category_id"),
//        ];
//    }
    public static function deleteByProductId(int $productId)
    {
        return Db::delete('products_images', "product_id = $productId");
    }

    public static function getListByProductId(int $productId)
    {
        $query = "SELECT *  FROM products_images  WHERE product_id = $productId";
        return Db::fetchAll($query);
    }
}
