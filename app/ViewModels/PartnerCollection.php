<?php

namespace App\ViewModels;

use LaravelCommon\ViewModels\PaggedCollection;
use LaravelOrm\Interfaces\IEntity;

class PartnerCollection extends PaggedCollection
{
    /**
     * @inheritdoc
     */
    public function shape(IEntity $entity)
    {
        $this->addItem(new PartnerViewModel($entity));
    }
}
