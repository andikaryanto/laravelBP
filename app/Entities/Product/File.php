<?php

namespace App\Entities\Product;

use App\Entities\Product;
use LaravelCommon\App\Entities\BaseEntity;

class File extends BaseEntity
{
    protected ?Product $product = null;
    protected ?string $name = null;
    protected ?string $type = null;
    protected ?string $extension = null;
    protected ?int $size = 0;

    /**
     * Set productId
     *
     * @param int productId
     * @return self
     */
    protected function setProduct(Product $product): File
    {
        $this->product = $product;
        return $this;
    }

    /**
     * Get productId
     *
     * @return Product
     */
    protected function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * Set name
     *
     * @param string name
     * @return self
     */
    public function setName(string $name): File
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set type
     *
     * @param string type
     * @return self
     */
    public function setType(string $type): File
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Set extension
     *
     * @param string extension
     * @return self
     */
    public function setExtension(string $extension): File
    {
        $this->extension = $extension;
        return $this;
    }

    /**
     * Get extension
     *
     * @return string
     */
    public function getExtension(): string
    {
        return $this->extension;
    }

    /**
     * Get the value of size
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * Set the value of size
     *
     * @return  self
     */
    public function setSize(int $size): File
    {
        $this->size = $size;

        return $this;
    }
}
