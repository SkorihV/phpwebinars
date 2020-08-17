<?php

/**
 * Created by PhpStorm.
 * User: vitaliy.skoryh
 * Date: 14.08.20
 * Time: 11:13
 */

namespace App\Product;

use App\Category;
use App\Category\CategoryModel;
use App\Product\ProductModel;
use App\Product\ProductRepository;
use App\ProductImage;
use App\Renderer;
use App\Request;

use App\Product;
use App\Response;
use App\Router\Route;


class ProductController
{
    /**
     * @var Route
     */
    private $route;

    public function __construct(Route $route)
    {
        $this->route = $route;
    }

    /**
     *
     */
    public function list(){
        $current_page = Request::getIntFromGet("p", 1);

        $limit = 10; //товаро нв странице
        $offset = ($current_page - 1) * $limit; // смещение товаров у пагинации


        $products_count = Product::getListCount();
        $pages_count = ceil($products_count / $limit); //количество страниц


        $productRepository = new ProductRepository();
        $products = $productRepository->getList($limit, $offset);



//$products = Product::getList( $limit, $offset);


        
        Renderer::getSmarty()->assign('page_count', $pages_count);
        Renderer::getSmarty()->assign('products', $products);
        Renderer::getSmarty()->display('products/index.tpl');

    }

    public function edit()
    {
        $productId = Request::getIntFromGet("id", null);
        if (is_null($productId)) {
            $productId = $this->route->getParam('id');
        }
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
                $category = new CategoryModel($categoryName);
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

        Renderer::getSmarty()->assign("categories", $categories);

        Renderer::getSmarty()->assign("product", $product);
        Renderer::getSmarty()->display("products/edit.tpl");

    }

    /**
     * @throws \Exception
     */
    public function add(){


        if (Request::isPost()){

            $productData = Product::getDataFromPost();

            $productRepository = new Product\ProductRepository();
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


        $product = new ProductModel("", 0, 0);
        $product->setCategory(new Category\CategoryModel(''));


        $categories = Category::getList();

        Renderer::getSmarty()->assign("categories", $categories);

        Renderer::getSmarty()->assign("product", $product);
        Renderer::getSmarty()->display('products/add.tpl');
    }

    public function delete(){
        $id = Request::getIntFromPost("id", false);
        if (!$id) {
            die ("Ошибка идентификатора");
        }

        $deleted = Product::deleteById($id);


        if($deleted){
            Response::redirect('/products/list');
        } else {
            die("Произошла ошибка с отправлением данных");
        }
    }

    public function deleteImage(){
        $productImageId = Request::getIntFromPost("product_image_id", false);

        if (!$productImageId) {
            die ("error with id");
        }

        $deleted = ProductImage::deleteById($productImageId);
        die('ok');
    }
}