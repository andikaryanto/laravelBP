<?php

namespace App\Entities\Product;

use App\Entities\Shop;
use LaravelCommon\App\Entities\BaseEntity;
use LaravelOrm\Entities\EntityList;

class Category extends BaseEntity
{
    /**
     * Undocumented variable
     *
     * @var string|null
     */
    protected ?string $name = null;

    /**
     * Undocumented variable
     *
     * @var string|null
     */
    protected ?string $description = null;

    /**
     * Undocumented variable
     *
     * @var EntityList|null
     */
    private ?EntityList $productCategotryMappings = null;

    /**
     * Undocumented variable
     *
     * @var Shop|null
     */
    private ?Shop $shop = null;


    /**
     * Set name
     *
     * @param string name
     * @return self
     */
    protected function setName(string $name): Category
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    protected function getName(): string
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param ?string description
     * @return self
     */
    protected function setDescription(?string $description): Category
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Get description
     *
     * @return ?string
     */
    protected function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Get the value of shop
     * @return ?Shop
     */
    public function getShop(): ?Shop
    {
        return $this->shop;
    }

    /**
     * Set the value of shop
     * @param Shop $shop
     * @return  self
     */
    public function setShop(Shop $shop): self
    {
        $this->shop = $shop;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  EntityList|null
     */
    public function getProductCategotryMappings(): ?EntityList
    {
        return $this->productCategotryMappings;
    }

    /**
     * Set undocumented variable
     *
     * @param  EntityList|null  $productCategotryMappings  Undocumented variable
     *
     * @return  self
     */
    public function setProductCategotryMappings(EntityList $productCategotryMappings)
    {
        $this->productCategotryMappings = $productCategotryMappings;

        return $this;
    }
}
