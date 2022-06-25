<?php

namespace App\ViewModels;

use App\ViewModels\UserViewModel;
use LaravelCommon\ViewModels\AbstractCollection;
use LaravelOrm\Interfaces\IEntity;

class UserCollection extends AbstractCollection
{
    /**
     * @inheritdoc
     */
    public function shape(IEntity $entity)
    {
        $this->addItem(new UserViewModel($entity));
    }
}
