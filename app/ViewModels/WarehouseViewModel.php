<?php

namespace App\ViewModels;

use App\Entities\Warehouse;
use LaravelCommon\ViewModels\AbstractViewModel;

class WarehouseViewModel extends AbstractViewModel
{
    /**
     * @var bool $autoAddResource;
     */
    protected $isAutoAddResource = true;

    /**
     * @var Warehouse
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
            'id' => $this->entity->getId(),
            'name' => $this->entity->getName(),
            'description' => $this->entity->getDescription(),
            'created_at' => !is_null($this->entity->getCreatedAt())
                ? $this->entity->getCreatedAt()->format('Y-m-d H:i:s')
                : null,
            'updated_at' => !is_null($this->entity->getUpdatedAt())
                ? $this->entity->getUpdatedAt()->format('Y-m-d H:i:s')
                : null
        ];
    }
}
