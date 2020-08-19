<?php

/**
 * Created by PhpStorm.
 * User: vitaliy.skoryh
 * Date: 14.08.20
 * Time: 11:13
 */

namespace App\Product;

use App\CategoryService;
use App\Category\CategoryModel;
use App\Renderer;

use App\Request;
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
     * @param ProductRepository $productRepository
     * @param Request $request
     *
     * @route("/product_list")
     */
    public function list(ProductRepository $productRepository, Request $request){
        $current_page = $request->getIntFromGet("p", 1);


        $limit = 5; //товаро нв странице
        $offset = ($current_page - 1) * $limit; // смещение товаров у пагинации


        $products_count = $productRepository->getListCount();
        $pages_count = ceil($products_count / $limit); //количество страниц


        $productRepository = new ProductRepository();
        $products = $productRepository->getList($limit, $offset);

//$products = Product::getList( $limit, $offset);

        Renderer::getSmarty()->assign('page_count', $pages_count);
        Renderer::getSmarty()->assign('products', $products);
        Renderer::getSmarty()->display('products/index.tpl');

    }

    /**
     * @param Request $request
     * @param ProductRepository $productRepository
     * @param ProductService $productService
     * @param ProductImageService $productImageService
     * @param Response $response
     * @param CategoryService $categoryService
     *
     * @route("/product_edit/{id}")
     */
    public function edit(
        Request $request,
         ProductRepository $productRepository,
         ProductService $productService,
         ProductImageService
         $productImageService,
         Response $response,
         CategoryService $categoryService)
    {

        $productId = $request->getIntFromGet("id", null);
        if (is_null($productId)) {
            $productId = $this->route->getParam('id');
        }
        $product = [];



        if ($productId) {
            $product = $productRepository->getById($productId);
        }


        if ($request->isPost()){
            $productData = $productService->getDataFromPost($request);

            $product->setName($productData['name']);
            $product->setArticle($productData['article']);
            $product->setDescription($productData['description']);
            $product->setAmount($productData['amount']);
            $product->setPrice($productData['price']);


            $categoryId = $productData['category_id'] ?? 0;

            if ($categoryId) {
                $categoryData = $categoryService->getById($categoryId);
                $categoryName = $categoryData['name'];
                $category = new CategoryModel($categoryName);
                $category->setId($categoryId);

                $product->setCategory($category);
            }

            $product = $productRepository->save($product);




            /*Загрузка изображений из УРЛ*/

            $imageURL = $_POST['image_url'] ?? '';
            $productImageService->uploadImagesByUrl($productId, $imageURL);


            /*Загрузка файлов в папку товара*/

            $uploadImages = $_FILES['images'] ?? []; // проверяем есть ли файлы в форме
            $productImageService->uploadImages($productId, $uploadImages);

            /*конец загрузки изображений*/

            $response->redirect('/products/list');
        }

        $categories = $categoryService->getList();

        Renderer::getSmarty()->assign("categories", $categories);

        Renderer::getSmarty()->assign("product", $product);
        Renderer::getSmarty()->display("products/edit.tpl");

    }

    /**
     * @param ProductImageService $productImageService
     * @param Request $request
     * @param Response $response
     * @param ProductService $productService
     * @param CategoryService $categoryService
     * @throws \Exception
     */
    public function add(
        ProductImageService $productImageService,
        Request $request,
        Response $response,
        ProductService $productService,
        CategoryService $categoryService
    ){


        if ($request->isPost()){

            /*
             *
             * ????
             *
             * */
            $productData = $productService->getDataFromPost();

            $productRepository = new ProductRepository();
            $product = $productRepository->getProductFromArray($productData);

            $product = $productRepository->save($product);


            $productId = $product->getId();



            /*Загрузка изображений из УРЛ*/


            $imageURL = trim($_POST['image_url'] ?? '');
            $productImageService->uploadImagesByUrl($productId, $imageURL);


            /*Загрузка файлов в папку товара*/

            $uploadImages = $_FILES['images'] ?? []; // проверяем есть ли файлы в форме
            $productImageService->uploadImages($productId, $uploadImages);

            if($productId){
                $response->redirect('/products/list');
            } else {
                die("Произошла ошибка с отправлением данных");
            }

        }


        $product = new ProductModel("", 0, 0);
        $product->setCategory(new CategoryModel(''));


        $categories = $categoryService->getList();

        Renderer::getSmarty()->assign("categories", $categories);

        Renderer::getSmarty()->assign("product", $product);
        Renderer::getSmarty()->display('products/add.tpl');
    }

    public function delete(){
        $id = Request::getIntFromPost("id", false);
        if (!$id) {
            die ("Ошибка идентификатора");
        }

        $deleted = ProductImageService::deleteById($id);


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

        $deleted = ProductImageService::deleteById($productImageId);
        die('ok');
    }
}