<?php

namespace App\ViewModels\Product;

use App\Entities\Product\File;
use App\ViewModels\ShopViewModel;
use LaravelCommon\App\ViewModels\UserViewModel;
use LaravelCommon\ViewModels\AbstractViewModel;

class FileViewModel extends AbstractViewModel
{
    /**
     * @var bool $autoAddResource;
     */
    protected $isAutoAddResource = true;

    /**
     * @var File
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
            'type' => $this->entity->getType(),
            'extension' => $this->entity->getExtension(),
            'created_at' => !is_null($this->entity->getCreatedAt())
                ? $this->entity->getCreatedAt()->format('Y-m-d H:i:s')
                : null,
            'updated_at' => !is_null($this->entity->getUpdatedAt())
                ? $this->entity->getUpdatedAt()->format('Y-m-d H:i:s')
                : null
        ];
    }
}
