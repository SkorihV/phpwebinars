<?php


use App\Data\Category\CategoryController;
use App\Data\Import\ImportController;
use App\Data\Product\ProductController;
use App\Data\Queue\QueueController;

 return [
    '/products/list' => [ ProductController::class, 'list'],
    '/products/edit' => [ ProductController::class, 'edit'],
    '/products/edit/{id}' => [ ProductController::class, 'edit'],
    '/products/{id}/edit' => [ ProductController::class, 'edit'],
    '/products/add' => [ ProductController::class, 'add'],
    '/products/delete' => [ ProductController::class, 'delete'],
    '/products/delete_image' => [ ProductController::class, 'deleteImage'],

    '/categories/list' => [ CategoryController::class, 'list'],
    '/categories/edit' => [ CategoryController::class, 'edit'],
    '/categories/edit/{id}' => [ CategoryController::class, 'edit'],
    '/categories/add' => [ CategoryController::class, 'add'],
    '/categories/delete' => [ CategoryController::class, 'delete'],
    '/categories/view' => [ CategoryController::class, 'view'],

    '/categories/view/{id}' => [ CategoryController::class, 'view'],
    '/categories/{id}/view' => [ CategoryController::class, 'view'],

    '/queue/run' => [ QueueController::class, 'run'],
    '/queue/list' => [ QueueController::class, 'list'],

    '/imports/index' => [ ImportController::class, 'index'],
    '/imports/upload' => [ ImportController::class, 'upload'],
];