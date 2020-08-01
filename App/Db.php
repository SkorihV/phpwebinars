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

   public static function fetchAll(string $query): array
   {
        $result =  static::query($query);
        $data = [];
        while($row = mysqli_fetch_assoc($result)){
            $data[] = $row;
        }
        return $data;
   }

   public static function fetchRow(string $query): array
   {
        $result = static::query($query);
        $data = mysqli_fetch_assoc($result);

        if (is_null($data)) {
            $data = [];
        }
        return $data;
   }

   public static function delete(string $tableName, string $where) {
       $query = "DELETE FROM " . $tableName;
       if ($where) {
           $query .= " WHERE " . $where;
       }
        static::query($query);

       return static::affectedRows();
   }

    public static function insert(string $tableName, array $fields)
    {
        $fieldNames = [];
        $fieldValues = [];

        foreach ($fields as $fieldName => $fieldValue) {
            $fieldNames[] = "`$fieldName`";
            $fieldValues[] = "'$fieldValue'";
        }

        $fieldNames = implode(",", $fieldNames);
        $fieldValues = implode(",", $fieldValues);

        $query = "INSERT INTO $tableName($fieldNames) VALUE ($fieldValues)";

        static::query($query);

        return static::lastInsertId();

    }

    public static function update(string $tableName, array $fields, string $where): int
    {

    $setFields = [];

    foreach ($fields as $fieldName => $fieldValue) {
        $setFields[] = "`$fieldName` = '$fieldValue'";
    }

        $setFields = implode(",", $setFields);

    $query = "UPDATE $tableName SET $setFields";

   if ($where) {
       $query .= (" WHERE " . $where);
   }
   Db::query($query);

   return static::affectedRows();

    }

    public static function fetchOne(string $query): string
    {
        $result = static::query($query);
        $row = mysqli_fetch_row($result);
        return (string) ($row[0] ?? '');
    }

    // Возвращает количество затронутых строк
    public static function affectedRows() {
       $connect = static::getConnect();
       return mysqli_affected_rows($connect);
    }

    //Возвращает последний id элемента
    public static function lastInsertId() {
        $connect = static::getConnect();
        return mysqli_insert_id($connect);
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