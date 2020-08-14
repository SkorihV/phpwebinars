<?php
/**
 * Created by PhpStorm.
 * User: vitaliy.skoryh
 * Date: 14.08.20
 * Time: 15:15
 */

namespace App\Category;


use App\Category;
use App\Product;
use App\Renderer;
use App\Request;
use App\Response;

class CategoryController
{
    /**
     * @var array
     */
    private $params;

    public function __construct(array $params)
    {
        $this->params = $params;
    }

    public function add(){
        if (Request::isPost()){
            $category = Category::getDataFromPost();
            $inserted = Category::add($category);

            if($inserted){
                Response::redirect('/categories/list');
            } else {
                die("Произошла ошибка с отправлением данных");
            }

        }

        Renderer::getSmarty()->display('categories/add.tpl');
    }


    public function delete(){

        $category_id = Request::getIntFromPost("id");
        if (!$category_id) {
            die ("Ошибка идентификатора");
        }

        $deleted = Category::deleteById($category_id);

        if($deleted){
            Response::redirect('/categories/list');
        } else {
            die("Произошла ошибка с отправлением данных");
        }

    }

    public function edit()
    {
        $id = Request::getIntFromGet("id");

        $category = [];

        if ($id) {
            $category = Category::getById($id);
        }

        if (Request::isPost()){
            $category = Category::getDataFromPost();
            $edited = Category::updateById($id, $category);


            if($edited){
                Response::redirect('/categories/list');
            } else {
                die("Произошла ошибка с отправлением данных");
            }
        }

        Renderer::getSmarty()->assign("category", $category);
        Renderer::getSmarty()->display("categories/edit.tpl");
    }

    public function list(){
        $categories = Category::getList();

        Renderer::getSmarty()->assign('categories', $categories);
        Renderer::getSmarty()->display('categories/index.tpl');

    }
    public function view(){
        $category_id = Request::getIntFromGet("id", null);
        if (is_null($category_id)) {
            $category_id = $this->params['id'] ?? null;
        }


        $category = Category::getById($category_id);


        $products = Product::getListByCategory( $category_id);
        Renderer::getSmarty()->assign("current_category", $category); //передаем в шаблон id текущей категории чтобы её подсветить в меню
        Renderer::getSmarty()->assign("products", $products);
        Renderer::getSmarty()->display("categories/view.tpl");
    }

}