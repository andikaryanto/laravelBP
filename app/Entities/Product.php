<?php

namespace App\Entities;

use App\Entities\Product\ProductCategoryMapping;
use App\Repositories\ProductRepository;
use DateTime;
use LaravelCommon\App\Entities\BaseEntity;
use LaravelOrm\Entities\EntityList;
use LaravelOrm\Exception\EntityException;

class Product extends BaseEntity
{
    /**
     * Undocumented variable
     *
     * @var ?string
     */
    private ?string $name = null;

    /**
     * Undocumented variable
     *
     * @var string|null
     */
    private ?string $description = null;

    /**
     * Undocumented variable
     *
     * @var Shop|null
     */
    private ?Shop $shop = null;

    /**
     * Undocumented variable
     *
     * @var integer
     */
    private int $rating = 0;

    /**
     * Undocumented variable
     *
     * @var boolean
     */
    private bool $isActive = false;

    /**
     * Undocumented variable
     *
     * @var boolean
     */
    private bool $isDeleted = false;

    /**
     * Undocumented variable
     *
     * @var DateTime|null
     */
    private ?DateTime $deletedAt = null;

    /**
     * Undocumented variable
     *
     * @var bool
     */
    private bool $mustShow = true;

    /**
     * Undocumented variable
     *
     * @var EntityList|null
     */
    private ?EntityList $productCategotryMappings = null;

    /**
     * Get undocumented variable
     *
     * @return  string
     */
    protected function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set undocumented variable
     *
     * @param  string  $name
     *
     * @return  Product
     */
    protected function setName(string $name): Product
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  string|null
     */
    protected function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Set undocumented variable
     *
     * @param  string|null
     *
     * @return  self
     */
    protected function setDescription(?string $description): Product
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function validate()
    {
        parent::validate();
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
     * @return  integer
     */
    public function getRating(): int
    {
        return $this->rating;
    }

    /**
     * Set undocumented variable
     *
     * @param  integer  $rating  Undocumented variable
     *
     * @return  self
     */
    public function setRating(int $rating): self
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  bool
     */
    public function getIsActive(): bool
    {
        return $this->isActive;
    }

    /**
     * Set undocumented variable
     *
     * @param  bool  $isActive  Undocumented variable
     *
     * @return  self
     */
    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  bool
     */
    public function getIsDeleted(): bool
    {
        return $this->isDeleted;
    }

    /**
     * Set undocumented variable
     *
     * @param  boolean  $isDeleted  Undocumented variable
     *
     * @return  self
     */
    public function setIsDeleted(bool $isDeleted): self
    {
        $this->isDeleted = $isDeleted;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  DateTime|null
     */
    public function getDeletedAt(): ?DateTime
    {
        return $this->deletedAt;
    }

    /**
     * Set undocumented variable
     *
     * @param  DateTime|null  $deletedAt  Undocumented variable
     *
     * @return  self
     */
    public function setDeletedAt($deletedAt): self
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    /**
     * Get undocumented variable
     *
     * @return  bool
     */
    public function getMustShow(): bool
    {
        return $this->mustShow;
    }

    /**
     * Set undocumented variable
     *
     * @param  bool  $mustShow  Undocumented variable
     *
     * @return  self
     */
    public function setMustShow(bool $mustShow): self
    {
        $this->mustShow = $mustShow;

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
