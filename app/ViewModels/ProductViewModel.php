<?php

namespace App\ViewModels;

use App\Entities\Product;
use LaravelCommon\ViewModels\AbstractViewModel;

class ProductViewModel extends AbstractViewModel
{
    /**
     * @var bool $autoAddResource;
     */
    protected $isAutoAddResource = true;

    /**
     * @var Product
     */
    protected $entity;

    /**
     * @inheritdoc
     */
    public function addResource(array &$element)
    {
        $shop = $this->entity->getShop();
        if ($shop) {
            $element['shop'] = (new ShopViewModel($shop))->toArray();
        }
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
            'rating' => $this->entity->getRating(),
            'is_active' => $this->entity->getIsActive(),
            'is_deleted' => $this->entity->getIsDeleted(),
            'deleted_at' => !is_null($this->entity->getDeletedAt())
                ? $this->entity->getDeletedAt()->format('Y-m-d H:i:s')
                : null,
            'must_show' => $this->entity->getMustShow(),
            'created_at' => !is_null($this->entity->getCreatedAt())
                ? $this->entity->getCreatedAt()->format('Y-m-d H:i:s')
                : null,
            'updated_at' => !is_null($this->entity->getUpdatedAt())
                ? $this->entity->getUpdatedAt()->format('Y-m-d H:i:s')
                : null
        ];
    }
}
