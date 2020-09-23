<?php

/**
 * Created by PhpStorm.
 * User: vitaliy.skoryh
 * Date: 14.08.20
 * Time: 15:37
 */

namespace App\Data\Import;

use App\Controller\AbstractController;
use App\Data\Import;
use App\Renderer\Renderer;
use App\Data\TasksQueue;

class ImportController extends AbstractController
{
    
    public function index(){

        Renderer::getSmarty()->display("import/index.tpl");
    }

    public function upload(){
        $file = $_FILES['import_file'] ?? null;

        if (is_null($file) || empty($file['name'])) {
            die("файл импорта не загружен");
        }

        $uploadDir = APP_PUBLIC_DIR . "/import";

        if (!file_exists($uploadDir)) {
            mkdir($uploadDir);
        }

        $importFileName = 'i_' . time() . '.' . $file['name'];
        move_uploaded_file($file['tmp_name'], $uploadDir . '/' . $importFileName);

//$fileName = 'i_1596515988.import 1.csv';
        $filePath = APP_PUBLIC_DIR . '/' . 'import/' . $importFileName;


        $taskName = 'Импорт товаров ' . $importFileName;
        $task = Import::class . '::productFromFileTask';
        $taskParams = [
            'fileName' => $importFileName
        ];

        TasksQueue::addTask($taskName, $task, $taskParams);
        return $this->redirect('/queue/list');

    }
}