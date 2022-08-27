<?php

namespace App\Entities\User;

use App\Entities\Shop;
use LaravelCommon\App\Entities\BaseEntity;
use LaravelCommon\App\Entities\User;
use LaravelOrm\Exception\DatabaseException;
use LaravelOrm\Repository\Repository;

class ShopMapping extends BaseEntity
{
    protected ?Shop $shop = null;
    protected ?User $user = null;

    /**
     * Get the value of shop
     */
    protected function getShop(): Shop
    {
        return $this->shop;
    }

    /**
     * Set the value of shop
     *
     * @return  self
     */
    protected function setShop(Shop $shop): self
    {
        $this->shop = $shop;

        return $this;
    }

    /**
     * Get the value of user
     */
    protected function getUser(): User
    {
        return $this->user;
    }

    /**
     * Set the value of user
     *
     * @return  self
     */
    protected function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function validate()
    {
        parent::validate();

        $params = [
            'where' => [
                ['user_shop_mappings.shop_id', '=', $this->getShop()->getId()],
                ['users.username', '=', $this->getUser()->getUsername()]
            ],
            'join' => [
                'users' => [
                    [
                        'key' => ['user_shop_mappings.user_id', '=',  'users.id']
                    ]
                ]
            ]
        ];

        $shopMappingRepo = new Repository(ShopMapping::class);
        $result = $shopMappingRepo->findOne($params);
        if (!is_null($result)) {
            throw new DatabaseException('username "' . $this->getUser()->getUsername() . '" exists');
        }
    }
}
