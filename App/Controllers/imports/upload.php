<?php

use App\Response;
use App\TasksQueue;

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
$task = 'Import::productFromFileTask';
$taskParams = [
    'fileName' => $importFileName
];

$taskId = TasksQueue::addTask($taskName, $task, $taskParams);

Response::redirect('/queue/list');



