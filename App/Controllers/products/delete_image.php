<?php
use App\ProductImage;
use App\Request;

$productImageId = Request::getIntFromPost("product_image_id", false);

if (!$productImageId) {
    die ("error with id");
}

$deleted = ProductImage::deleteById($productImageId);



