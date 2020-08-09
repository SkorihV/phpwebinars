<?php


namespace App\Product;


use App\Category\Category;
use App\Db\Db;
use App\ProductImage;

class ProductRepository
{
    /**
     * @param array $data
     * @return Product
     * @throws \Exception
     */
    public function getProductFromArray(array $data): Product
    {
        $id = $data['id'];

        $name = $data['name'] ?? null;
        $price = $data['price'] ?? null;
        $amount = $data['amount'] ?? null;

        if(is_null($name)) {
            throw  new \Exception('Имя не задано для товара');
        }
        if(is_null($price)) {
            throw new \Exception('цена не задано для товара');
        }
        if(is_null($amount)) {
            throw new \Exception('количество не задано для товара');
        }

        $article = $data['article'] ?? '';
        $description = $data['description']?? '';

        $categoryId = $data['category_id'] ?? 0;
        $product = new Product($name, $price, $amount);


        if ($categoryId > 0) {
            $categoryName = $data['category_name'] ?? '';
            $category = new Category($categoryName);

            $category->setId($categoryId);
            $product->setCategory($category);
        }


        $product->setid($id);
        $product->setArticle($article);
        $product->setDescription($description);

        return $product;
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return Product[]
     */
    public function getList(int $limit = 50, $offset = 0): array
    {
        $query = "SELECT p.*, c.name as category_name FROM products p LEFT JOIN categories c ON p.category_id = c.id LIMIT $offset, $limit";
        $result = Db::query($query);

        $products = [];

        while  ($productArray = Db::fetchAssoc($result) ){
          $product = $this->getProductFromArray($productArray);

            $products[] = $product;
        }

//        foreach ($products as &$product) {
//            $product['images'] = ProductImage::getListByProductId($product['id']);
//
//        }

        return $products;

    }
}