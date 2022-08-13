<?php

namespace App\Repositories;

use App\Entities\Warehouse;
use App\Repositories\WarehouseRepositoryInterface;
use App\ViewModels\WarehouseCollection;
use App\ViewModels\WarehouseViewModel;
use LaravelCommon\App\Repositories\BaseRepository;

class WarehouseRepository extends BaseRepository implements WarehouseRepositoryInterface
{
    /**
    * Constrcutor
    */
    public function __construct()
    {
        parent::__construct(Warehouse::class);
    }

    /**
     * @inheritDoc
     *
     * @return string
     */
    public function collectionClass(): string
    {
        return WarehouseCollection::class;
    }

    /**
     * @inheritDoc
     *
     * @return stirng
     */
    public function viewModelClass(): string
    {
        return WarehouseViewModel::class;
    }
}
