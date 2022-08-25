<?php

namespace App\Repositories\User;

use App\Entities\Shop;
use App\Entities\User\ShopMapping;
use LaravelCommon\App\Entities\User;
use LaravelCommon\App\Repositories\BaseRepository;

class ShopMappingRepository extends BaseRepository implements ShopMappingRepositoryInterface
{
    /**
     * Constrcutor
     */
    public function __construct()
    {
        parent::__construct(ShopMapping::class);
    }

    /**
     * Get user's shop
     *
     * @param User $user
     * @return ?Shop
     */
    public function getShopByUser(User $user): ?Shop
    {
        $param = [
            'where' => [
                ['user_id', '=', $user->getId()]
            ]
        ];

        $userShop = $this->find($param);
        if (!is_null($userShop)) {
            return $userShop->getShop();
        }

        return null;
    }

    /**
     * @inheritDoc
     *
     * @return string
     */
    public function collectionClass(): string
    {
        return ShopMappingCollection::class;
    }

    /**
     * @inheritDoc
     *
     * @return stirng
     */
    public function viewModelClass(): string
    {
        return ShopMappingViewModel::class;
    }
}
