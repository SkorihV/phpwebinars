<?php

namespace App;

use App\Db\Db;

class ProductImage {

    private CONST IMAGES_MIME_DICT = [
            'image/apng' => '.apng',
            'image/bmp' => '.bmp',
            'image/gif' => '.gif',
            'image/x-icon' => '.ico',
            'image/jpeg' => '.jpg',
            'image/svg+xml' => '.svg',
            'image/tiff' => '.tiff',
            'image/webp' => '.webp',
        ];

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
        $productImage = static::getById($id);
        $filePath = APP_PUBLIC_DIR . $productImage['path'];
        if(file_exists($filePath)) {
            unlink($filePath);
        }
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

    public static function uploadImages(int $productId, array $files) {

        $imageNames = $files['name'] ?? [];  // забираем массив с именами файлов
        $imageTmpNames = $files['tmp_name'] ?? []; // масств с временными путями к файлам
        $imageCount = 0;

        for ($i = 0; $i < count($imageNames); $i++) {

            $result = static::uploadImage($productId, [
                "name" => $imageNames[$i],
                "tmp_name" =>$imageTmpNames[$i],
            ]);
            if ($result) {
                $imageCount++;
            }
        }

        return $imageCount;
    }

    public static function uploadImage(int $productId, array $file){
        $imageName = basename(trim($file['name']));  // обрезаем пути до имени файла если они есть

        if (empty($imageName)) {
            return false;
        }

        $imageTmpName = $file['tmp_name'];

        $filename = static::getUniqueUploadImageName($productId, $imageName);

        $path =  static::getUploadDirForProduct($productId);
        $imagePath = $path . "/" . $filename;


            move_uploaded_file($imageTmpName, $imagePath);  // перебрасываем файлы из временной папки формы в постоянную по id товара
            ProductImage::add([
                'product_id' => $productId,
                'name' => $filename,
                'path' => str_replace(APP_PUBLIC_DIR, '', $imagePath),
            ]);

        return true;
    }

    protected static function getUniqueUploadImageName(int $productId,string $imageName) {
        $filename = $imageName;
        $counter = 0;

        while (true) {
            $duplicateImage = ProductImage::findByFileNameInProduct($productId, $filename);
            if (empty($duplicateImage)) {
                break;
            }

            $info = pathinfo($imageName);
            $filename = $info['filename'];
            $filename .= '_' . $counter . '.' . $info['extension'];
            $counter++;
        }

        return $filename;
    }

    public static function uploadImagesByUrl (int $productId, string  $imageURL) {
        if (empty($imageURL)){
            return false;
        }

        $imageMetaData = static::getMetaDataByUrl($imageURL);
        $mimeType = $imageMetaData['mimeType'];
        if (is_null($mimeType)) {
            return false;
        }

        $imageExt = static::getExtensionByMimeType($mimeType);

        if (is_null($imageExt)) {
            return false;
        }

        $size = $imageMetaData['size'];
        if (is_null($size)) {
            return false;
        }
        
        $duplicateProductImage = ProductImage::getByProductIdAndSize($productId, $size);
        if(!empty($duplicateProductImage)){
            return false;
        }

        $productImageId = ProductImage::add([
            'product_id' => $productId,
            'name' => '',
            'path' => '',
            'size' => $size,
        ]);
        $filename = $productId . "_" . $productImageId . "_upload" . time() . $imageExt;
        $path =  static::getUploadDirForProduct($productId);
        $imagePath = $path . "/" . $filename;

        file_put_contents($imagePath, fopen($imageURL, 'r'));

        ProductImage::updateById($productImageId, [
            'name' => $filename,
            'path' => str_replace(APP_PUBLIC_DIR, '', $imagePath),
        ]);
    return  true;
    }

    protected static function getExtensionByUrl(string $url) {
        $metaData = static::getMetaDataByUrl($url);
        $mimeType = $metaData['mimeType'];

        return static::IMAGES_MIME_DICT[$mimeType] ?? null;
    }

    protected static function getExtensionByMimeType(string $mimeType) {
        return static::IMAGES_MIME_DICT[$mimeType] ?? null;
    }

    protected static function getMetaDataByUrl(string $url)
    {
        $headers = @get_headers($url);
        if ($headers === false) {
            return null;
        }

        $metaDataHeaders = [
            'Content-Length',
            'Content-Type'
        ];

         $metaData= [
             'mimeType' => null,
            'size' => null,
        ];

        $mimeType = null;
        foreach ($headers as $headerStr) {

            $header = null;

            foreach ($metaDataHeaders as $metaDataHeader) {
                if (strpos(strtolower($headerStr), strtolower($metaDataHeader)) === false) {
                    continue;
                }
                $header = $metaDataHeader;
                break;
            }

            if(is_null($header)) {
                continue;
            }

            $headerData = explode(':', $headerStr);
            $headerValue = trim(strtolower($headerData[1] ?? ''));

            switch ($header) {
                case 'Content-Length':
                    $metaData['size'] = $headerValue;
                    break;
                case 'Content-Type':
                    $metaData['mimeType'] =$headerValue;
                        break;
            }
        }

        return $metaData;

    }

    public static function getListByProductId(int $productId)
    {
        $query = "SELECT *  FROM products_images  WHERE product_id = $productId";
        return Db::fetchAll($query);
    }



    protected static function getUploadDirForProduct(int $productId) {
        $path = APP_UPLOAD_PRODUCTS_DIR . '/' . $productId; // формируем адрес пусти для файлов конкретного товара по его ID
        if(!file_exists($path)){
            mkdir($path);  // создаем папку с id товара если такой нет
        }
        return $path;

    }

    private static function getByProductIdAndSize(int $productId, $size)
    {
        $query = "SELECT * FROM products_images WHERE product_id = '$productId' AND size = '$size'";
        return Db::fetchRow($query);
    }
}
