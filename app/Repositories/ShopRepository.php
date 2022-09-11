<?php

namespace App\Repositories;

use App\Entities\Shop;
use App\Repositories\ShopRepositoryInterface;
use App\ViewModels\ShopCollection;
use App\ViewModels\ShopViewModel;
use LaravelCommon\App\Repositories\Repository;

class ShopRepository extends Repository implements ShopRepositoryInterface
{
    /**
    * Constrcutor
    */
    public function __construct()
    {
        parent::__construct(Shop::class);
    }

    /**
     * @inheritDoc
     *
     * @return string
     */
    public function collectionClass(): string
    {
        return ShopCollection::class;
    }

    /**
     * @inheritDoc
     *
     * @return stirng
     */
    public function viewModelClass(): string
    {
        return ShopViewModel::class;
    }
}
