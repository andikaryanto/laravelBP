<?php

namespace App\Repositories;

use App\Entities\Warehouse;
use App\Repositories\WarehouseRepositoryInterface;
use LaravelOrm\Repository\Repository;

class WarehouseRepository extends Repository implements WarehouseRepositoryInterface
{
    /**
    * Constrcutor
    */
    public function __construct()
    {
        parent::__construct(Warehouse::class);
    }
}
