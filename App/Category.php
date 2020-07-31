<?php

class Category {
    public static function getList() {
        $query = "SELECT * FROM categories";
        $result =  Db::query($query);
        $category = [];
        while($row = mysqli_fetch_assoc($result)){
            $category[] = $row;
        }
        return $category;
    }

    public static function getById( $id){
        $query = "SELECT * FROM categories WHERE id = $id";
        $result = Db::query($query);
        $category = mysqli_fetch_assoc($result);

        if (is_null($category)) {
            $category = [];
        }
        return $category;
    }

    public static function updateById( $id, $category){
        $name = $category['name'] ?? '';
        $query = "UPDATE categories SET name = '$name' WHERE id = $id";
        Db::query($query);

        return Db::affectedRows();
    }

    public static function add($category){
        $name = $category['name'] ?? '';
        $query = "INSERT INTO categories (`name`) VALUES ('$name')";
        Db::query($query);

        return Db::affectedRows();
    }

    public static function deleteById($id){
        $query = "DELETE FROM categories WHERE id = $id";
        Db::query($query);

        return Db::affectedRows();
    }

    public static function getDataFromPost(){
        return [
            'name' => $_POST['name'] ?? '',
        ];
    }
}
