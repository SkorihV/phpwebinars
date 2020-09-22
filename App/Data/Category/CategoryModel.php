<?php

namespace App\Data\Category;

class CategoryModel
{
    /**
     * @var int
     */
    protected $id = 0;

    /**
     * @var string
     */
    protected $name;

    public function __construct(string $name)
    {
        $this->setName($name);

    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return $this
     */
    public function setId(int $id)
    {
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
     * @return $this
     */
    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }



}