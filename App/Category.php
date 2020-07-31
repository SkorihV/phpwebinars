<?php

class Category {
    public static function getList() {
        $query = "SELECT * FROM categories";
        return Db::fetchAll($query);
    }

    public static function getById($id){
        $query = "SELECT * FROM categories WHERE id = $id";
        return Db::fetchRow($query);
    }

    public static function updateById(int $id, array $category){
        if (isset($category['id'])){
            unset($category['id']);
        }
        return Db::update("categories", $category, "id = $id");
    }

    public static function add(array $category){
        if (isset($category['id'])){
            unset($category['id']);
        }
        return Db::insert("categories", $category);
    }

    public static function deleteById($id){
          return Db::delete("categories", "id = $id");
    }

    public static function getDataFromPost(){
        return [
            'id' => Request::getIntFromPost("id", false),
            'name' => Request::getStrFromPost("name"),
        ];
    }
}
