<?php

namespace App\Queries;

use App\Entities\ProductCategory;
use App\Entities\Shop;
use App\ViewModels\ProductCategoryCollection;
use LaravelCommon\App\Queries\Query;

class ProductCategoryQuery extends Query
{
    public function identity()
    {
        return ProductCategory::class;
    }

    public function collectionClass()
    {
        return ProductCategoryCollection::class;
    }

    /**
     * Filter by shop
     *
     * @param Shop $shop
     * @return self
     */
    public function whereShop(Shop $shop): ProductCategoryQuery
    {
        $table = $this->getIdentityTable();
        $this->where($table . '.shop_id', '=', $shop->getId());
        return $this;
    }
}
