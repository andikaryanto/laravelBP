<?php

namespace App\Queries\Product;

use App\Entities\Product\Category;
use App\Entities\Shop;
use LaravelOrm\Queries\Query;

class CategoryQuery extends Query
{
    public function identity()
    {
        return Category::class;
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
