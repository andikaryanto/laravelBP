<?php

namespace App\Repositories\Partner;

use App\Entities\Partner\Shop;
use App\ViewModels\Partner\ShopCollection;
use App\ViewModels\Partner\ShopViewModel;
use LaravelCommon\App\Repositories\BaseRepository;

class ShopRepository extends BaseRepository implements ShopRepositoryInterface
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
