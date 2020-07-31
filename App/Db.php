<?php


class Db
{
   private static $host = '127.0.0.1';
   private static $user = 'root';
   private static $password = '';
   private static $database = 'phpwebinars';

   private static $connect;


   public static function getConnect(){
       if (is_null(static::$connect)){
           static::$connect = static::connect();
       }

       return static::$connect;
   }

   public static function query($query) {
       $connect = static::getConnect();
       $result = mysqli_query($connect, $query);

       if (mysqli_errno($connect)){
            $error = mysqli_error($connect);
            var_dump($error);
            exit;
       }
       return  $result;
    }

    public static function affectedRows() {
       $connect = static::getConnect();
       return mysqli_affected_rows($connect);
    }

    private static function connect() {
        $connect = mysqli_connect(static::$host, static::$user, static::$password, static::$database);
        if (mysqli_connect_errno()){
            $error = mysqli_connect_error();
            var_dump($error);
            exit;
        }
        return $connect;
    }
}