<?php
$controller_path = $_SERVER['DOCUMENT_ROOT'] . '/../App/Controllers' . $_SERVER['PATH_INFO'] . '.php';
$controller_path = $_SERVER['DOCUMENT_ROOT'] . '/../App/Controllers' . $_SERVER['REQUEST_URI'];
require_once $controller_path;
