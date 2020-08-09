<?php

namespace App\Category;

class Category
{
    /**
     * @var int
     */
    protected $id;

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
     */
    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }



}