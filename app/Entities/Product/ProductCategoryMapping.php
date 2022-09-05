<?php

namespace App\Entities\Product;

use App\Entities\Product;
use LaravelCommon\App\Entities\BaseEntity;

class ProductCategoryMapping extends BaseEntity
{
    protected ?Product $product = null;
    protected ?Category $productCategoryId = null;

    /**
     * Set product
     *
     * @param Product product
     * @return self
     */
    protected function setProduct(Product $product): ProductCategoryMapping
    {
        $this->product = $product;
        return $this;
    }

    /**
     * Get productId
     *
     * @return ?Product
     */
    protected function getProduct(): ?Product
    {
        return $this->product;
    }

    /**
     * Set productCategory
     *
     * @param Category productCategory
     * @return self
     */
    protected function setProductCategory(Category $productCategory): ProductCategoryMapping
    {
        $this->productCategory = $productCategory;
        return $this;
    }

    /**
     * Get productCategoryId
     *
     * @return ?Category
     */
    protected function getProductCategory(): Category
    {
        return $this->productCategory;
    }
}
