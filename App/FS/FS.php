<?php
/**
 * Created by PhpStorm.
 * User: vitaliy.skoryh
 * Date: 17.09.20
 * Time: 16:08
 */

namespace App\FS;


class FS
{

    public function deleteDir($dir) {
        $files = array_diff(scandir($dir), array('.','..')); // получаем список вложенных файлов и папок

        // обрабатываем весь список рекурсивной функцией и удаляем содержимое папок
        foreach ($files as $file) {
            if (is_dir("$dir/$file")) {
               $this->deleteDir("$dir/$file");
            }  else {
                unlink("$dir/$file");
            }
        }
        return rmdir($dir);

    }

    /**
     * @param string $dirName
     * @return array
     */
    public function scanDir(string $dirName) {
        $list = scandir($dirName);

        $list = array_filter($list, function($item){
            return !in_array($item, ['.','..']);
        });

        $fileNames = [];

        foreach ($list as $fileItem) {
            $filePath = $dirName . '/' . $fileItem;
            if (!is_dir($filePath)) {
                $fileNames[] = $filePath;
            } else {
                $fileNames = array_merge($fileNames, $this->scanDir($filePath));
            }
        }

        return $fileNames;
    }
}