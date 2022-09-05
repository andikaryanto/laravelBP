<?php

namespace App\ViewModels\Product;

use LaravelCommon\ViewModels\PaggedCollection;
use LaravelOrm\Interfaces\IEntity;

class ProductCategoryMappingCollection extends PaggedCollection
{
    /**
     * @inheritdoc
     */
    public function shape(IEntity $entity)
    {
        $this->addItem(new ProductCategoryMappingViewModel($entity));
    }
}
