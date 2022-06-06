<?php

namespace App\ViewModels\Mgroupuser;

use LaravelCommon\ViewModels\AbstractCollection;
use LaravelOrm\Interfaces\IEntity;

class MgroupuserCollection extends AbstractCollection
{
    /**
     * @inheritdoc
     */
    public function shape(IEntity $entity)
    {
        $this->addItem(new MgroupuserViewModel($entity));
    }
}
