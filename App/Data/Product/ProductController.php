<?php

/**
 * Created by PhpStorm.
 * User: vitaliy.skoryh
 * Date: 14.08.20
 * Time: 11:13
 */

namespace App\Data\Product;

use App\CategoryService;
use App\Data\Category\CategoryModel;
use App\Controller\AbstractController;

use App\Http\Request;
use App\Http\Response;



class ProductController extends AbstractController
{
//    /**
//     * @var Route
//     */
//    private $route;

    public function __construct()
    {
//        $this->route = $route;
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


        $productsCount = $productRepository->getListCount();
        $pagesCount = ceil($productsCount / $limit); //количество страниц


        $productRepository = new ProductRepository();
        $products = $productRepository->getList($limit, $offset);

//$products = Product::getList( $limit, $offset);

        return $this->render('products/index.tpl', [
            "page_count" => $pagesCount,
            "products" => $products,
        ]);
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
         ProductImageService $productImageService,
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

            return $this->redirect('/products/list');
            //$response->redirect('/products/list');
        }

        $categories = $categoryService->getList();

        return $this->render("products/edit.tpl", [
            "categories" => $categories,
            "product" => $product,
        ]);
    }

    /**
     * @param ProductRepository $productRepository
     * @param ProductImageService $productImageService
     * @param Request $request
     * @param Response $response
     * @param ProductService $productService
     * @param CategoryService $categoryService
     * @return mixed
     * @throws \Exception
     */
    public function add(
        ProductRepository $productRepository,
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
            $productData = $productService->getDataFromPost($request);

            $product = $productRepository->getProductFromArray($productData);

            $product = $productRepository->save($product);


            $productId = $product->getId();

            /*Загрузка изображений из УРЛ*/

            $imageURL = trim($request->getStrFromPost('image_url'));
            $productImageService->uploadImagesByUrl($productId, $imageURL);

            /*Загрузка файлов в папку товара*/

            $uploadImages = $_FILES['images'] ?? []; // проверяем есть ли файлы в форме
            $productImageService->uploadImages($productId, $uploadImages);

            if($productId){
               return $this->redirect('/products/list');
            } else {
                die("Произошла ошибка с отправлением данных");
            }

        }

        $product = new ProductModel("", 0, 0);
        $product->setCategory(new CategoryModel(''));


        $categories = $categoryService->getList();

        return $this->render("products/add.tpl", [
            "categories" => $categories,
            "product" => $product,
        ]);
    }

    public function delete(
            Request $request,
           ProductImageService $productService,
            Response $response){
        $id = $request->getIntFromPost("id", false);
        if (!$id) {
            die ("Ошибка идентификатора");
        }

        $deleted = $productService->deleteById($id);


        if($deleted){
           return $this->redirect('/products/list');
        } else {
            die("Произошла ошибка с отправлением данных");
        }
    }

    /**
     * @param Request $request
     * @param ProductImageService $productImageService
     */
    public function deleteImage(Request $request, ProductImageService $productImageService){
        $productImageId = $request->getIntFromPost("product_image_id", false);

        if (!$productImageId) {
            die ("error with id");
        }

        $productImageService->deleteById($productImageId);
        die('ok');
    }
}