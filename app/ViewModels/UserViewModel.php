<?php

namespace App\ViewModels;

use App\Entities\User;
use LaravelCommon\App\Entities\Groupuser;
use LaravelCommon\App\ViewModels\GroupuserViewModel;
use LaravelCommon\App\ViewModels\UserViewModel as ViewModelsUserViewModel;
use stdClass;

class UserViewModel extends ViewModelsUserViewModel
{
    /**
     * @var bool $autoAddResource;
     */
    protected $isAutoAddResource = true;

    /**
     * @var User $entity
     */
    protected $entity;

    /**
     * @inheritdoc
     */
    public function addResource(array &$element)
    {
        /**
         * @var Groupuser $groupuser
         */
        $groupuser = $this->entity->getGroupuser();
        if (!empty($groupuser)) {
            $element['groupuser'] = (new GroupuserViewModel($groupuser))->toArray();
        }

        $shop = $this->entity->getShop();
        if (!empty($shop)) {
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
            'username' => $this->entity->getUsername(),
            "is_active" => (bool)$this->entity->getIsActive()
        ];
    }
}
