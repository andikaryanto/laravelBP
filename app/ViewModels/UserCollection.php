<?php

namespace App\ViewModels;

use LaravelCommon\App\ViewModels\UserCollection as ViewModelsUserCollection;
use LaravelOrm\Interfaces\IEntity;

class UserCollection extends ViewModelsUserCollection
{
    /**
     * @inheritdoc
     */
    public function shape(IEntity $entity)
    {
        $this->addItem(new UserViewModel($entity));
    }
}
