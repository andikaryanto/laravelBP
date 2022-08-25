<?php

namespace App\ViewModels\User;

use App\Entities\Product\ShopMapping;
use App\ViewModels\ShopViewModel;
use LaravelCommon\App\ViewModels\UserViewModel;
use LaravelCommon\ViewModels\AbstractViewModel;

class ShopMappingViewModel extends AbstractViewModel
{
    /**
     * @var bool $autoAddResource;
     */
    protected $isAutoAddResource = true;

    /**
     * @var ShopMapping
     */
    protected $entity;

    /**
     * @inheritdoc
     */
    public function addResource(array &$element)
    {
        $user = $this->entity->getUser();
        if($user){
            $element['user'] = (new UserViewModel($user))->toArray();
        }

        $shop = $this->entity->getShop();
        if($shop){
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
            'created_at' => !is_null($this->entity->getCreatedAt()) 
                ? $this->entity->getCreatedAt()->format('Y-m-d H:i:s') 
                : null,
            'updated_at' => !is_null($this->entity->getUpdatedAt()) 
                ? $this->entity->getUpdatedAt()->format('Y-m-d H:i:s')
                : null
        ];
    }
}
