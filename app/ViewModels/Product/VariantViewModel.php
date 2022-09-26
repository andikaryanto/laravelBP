<?php

namespace App\ViewModels\Product;

use App\Entities\Product\Variant;
use LaravelCommon\ViewModels\AbstractViewModel;

class VariantViewModel extends AbstractViewModel
{
    /**
     * @var bool $autoAddResource;
     */
    protected $isAutoAddResource = true;

    /**
     * @var Variant
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
            'price' => $this->entity->getPrice(),
            'stock' => $this->entity->getStock(),
            'saleable_stock' => $this->entity->getSaleableStock(),
            'condition' => $this->entity->getCondition(),
            'weight' => $this->entity->getWeight(),
            'height' => $this->entity->getHeight(),
            'width' => $this->entity->getWidth(),
            'length' => $this->entity->getLength(),
            'created_at' => !is_null($this->entity->getCreatedAt())
                ? $this->entity->getCreatedAt()->format('Y-m-d H:i:s')
                : null,
            'updated_at' => !is_null($this->entity->getUpdatedAt())
                ? $this->entity->getUpdatedAt()->format('Y-m-d H:i:s')
                : null
        ];
    }
}
