<?php

namespace App\Queries\Product;

use App\Entities\Product\Category;
use App\Entities\Shop;
use App\ViewModels\Product\CategoryCollection;
use LaravelCommon\App\Queries\Query;

class CategoryQuery extends Query
{
    public function identity()
    {
        return Category::class;
    }

    public function collectionClass()
    {
        return CategoryCollection::class;
    }

    /**
     * Filter by shop
     *
     * @param Shop $shop
     * @return self
     */
    public function whereShop(Shop $shop): CategoryQuery
    {
        $table = $this->getIdentityTable();
        $this->where($table . '.shop_id', '=', $shop->getId());
        return $this;
    }
}
