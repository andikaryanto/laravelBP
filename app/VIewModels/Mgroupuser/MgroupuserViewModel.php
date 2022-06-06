<?php

namespace App\ViewModels\Mgroupuser;

use App\Entities\Mgroupuser;
use LaravelCommon\ViewModels\AbstractViewModel;
use LaravelOrm\Entities\EntityList;
use stdClass;

class MgroupuserViewModel extends AbstractViewModel
{
    /**
     * @var bool $autoAddResource;
     */
    protected $isAutoAddResource = true;

    /**
     * @var Mgroupuser
     */
    protected $entity;

    /**
     * @inheritdoc
     */
    public function addResource(array &$element)
    {

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function toArray()
    {
        return [
            'Id' => $this->entity->getId(),
            'GroupName' => $this->entity->getGroupName()
        ];
    }
}
