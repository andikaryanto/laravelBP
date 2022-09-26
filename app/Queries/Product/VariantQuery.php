<?php

namespace App\Queries\Product;

use App\Entities\Product;
use App\Entities\Product\Variant;
use App\ViewModels\Product\VariantCollection;
use LaravelCommon\App\Queries\Query;

class VariantQuery extends Query
{
    public function identity()
    {
        return Variant::class;
    }

    public function collectionClass()
    {
        return VariantCollection::class;
    }

    public function whereProduct(Product $product): VariantQuery{
        $this->where('product_id', '=', $product->getId());
        return $this;
    }
}
