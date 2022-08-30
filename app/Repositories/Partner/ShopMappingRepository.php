<?php

namespace App\Repositories\Partner;

use App\Entities\Partner\ShopMapping;
use App\ViewModels\Partner\ShopMappingCollection;
use App\ViewModels\Partner\ShopMappingViewModel;
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
