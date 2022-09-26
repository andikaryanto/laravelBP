<?php

namespace App\ViewModels\Product;

use LaravelCommon\ViewModels\PaggedCollection;
use LaravelOrm\Interfaces\IEntity;

class VariantCollection extends PaggedCollection
{
    /**
     * @inheritdoc
     */
    public function shape(IEntity $entity)
    {
        $this->addItem(new VariantViewModel($entity));
    }
}
