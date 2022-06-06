<?php

namespace App\ViewModels\Muser;

use LaravelCommon\ViewModels\AbstractCollection;
use LaravelOrm\Interfaces\IEntity;

class MuserCollection extends AbstractCollection
{
    /**
     * @inheritdoc
     */
    public function shape(IEntity $entity)
    {
        $this->addItem(new MuserViewModel($entity));
    }
}
