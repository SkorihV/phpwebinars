<?php

namespace App\Config;
use App\Config\Exception\ConfigDirectoryNotFoundException;
use App\FS\FS;

/**
 * Created by PhpStorm.
 * User: vitaliy.skoryh
 * Date: 17.09.20
 * Time: 15:44
 */



class Config
{


    public function parse($dirname)
    {

        $dirname = APP_DIR . '/' . $dirname;

        if (!file_exists($dirname) || !is_dir($dirname)) {
            throw new ConfigDirectoryNotFoundException($dirname);
        }

        $fs = new FS();
        $fileList = $fs->scanDir($dirname);


        $defaultConfig = [];
        $appConfig = [];

        foreach ($fileList as $fileConfig) {
            if ( strpos($fileConfig, 'conf.d') !== false) {
                $defaultConfig[] = $this->parseConfigPath($fileConfig, $dirname . '/conf.d');
                continue;
            }

            $appConfig[] = $this->parseConfigPath($fileConfig, $dirname . '/');;
        }

//        $fileList = array_map(function($item) use ($dirname){
//            return str_replace($dirname, '', $item);
//        }, $fileList);

//        foreach ($fileList as &$fileName) {
//            $fileName = str_replace(APP_DIR, '', $fileName);
//        }

        echo "<pre>";
        var_dump($defaultConfig, $appConfig);
    }

    private function parseConfigPath(string  $configFilePath, string $replacePart = '')
    {
        if (!file_exists($configFilePath)) {
            throw new ConfigDirectoryNotFoundException($configFilePath);
        }

        $data = [];
        $data['src'] = include $configFilePath;
        $data['namePath'] = str_replace($replacePart, '', $configFilePath);

        return $data;
    }

}