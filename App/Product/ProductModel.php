<?php

namespace App\Product;

use App\Category\CategoryModel;

class ProductModel
{
    /**
     * @var int
     */
    protected $id = 0;

    /**
     * @var string
     */
    protected $name = '';

    /**
     * @var string
     */
    protected $article = '';

    /**
     * @var float
     */
    protected $price = 0;

    /**
     * @var int
     */
    protected $amount = 0;

    /**
     * @var string
     */
    protected $description = '';

    /**
     * @var CategoryModel
     */
    protected $category = 0;

    /**
     * @var PraductImage[]
     */
    protected $images = [];


    public function __construct(string $name, float $price, int $amount)
    {
        $this->setName($name);
        $this->setPrice($price);
        $this->setAmount($amount);
    }

    /**
     * @return int
     */
    public function getId() {

        return $this->id;
    }

    /**
     * @param int $id
     * @return $this
     */
    public function setId(int $id) {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getArticle(): string
    {
        return $this->article;
    }

    /**
     * @param string $article
     */
    public function setArticle(string $article)
    {
        $this->article = $article;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price)
    {
        $this->price = $price;
    }

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * @param int $amount
     */
    public function setAmount(int $amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    /**
     * @return CategoryModel|null
     */
    public function getCategory(): CategoryModel
    {
        return $this->category;
    }

    /**
     * @param CategoryModel $category
     * @return ProductModel
     */
    public function setCategory(CategoryModel $category)
    {
        $this->category = $category;
        return $this;
    }

    /**
     * @return ProductImageModel[]
     */
    public function getImages(): array
    {
        return $this->images;
    }

    /**
     * @param ProductImageModel[] $images
     * $return product
     */
    public function setImages(array $images)
    {
        $this->images = $images;
    }

    public function addImage(ProductImageModel $productImage): ProductModel
    {
        $this->images[] = $productImage;
        return $this;
    }

}