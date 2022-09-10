<?php

namespace App\Queries;

use App\Entities\Product\Category;
use App\Entities\Shop;
use App\ViewModels\ShopCollection;
use LaravelCommon\App\Queries\Query;

class ShopQuery extends Query
{
    public function identity()
    {
        return Shop::class;
    }

    public function collectionClass()
    {
        return ShopCollection::class;
    }
}
