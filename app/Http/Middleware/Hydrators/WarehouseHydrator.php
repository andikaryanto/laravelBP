<?php

namespace App\Http\Middleware\Hydrators;

use App\Entities\Warehouse;
use App\Repositories\WarehouseRepository;
use LaravelCommon\App\Http\Middleware\Hydrator;


class WarehouseHydrator extends Hydrator
{

    /**
     *
     * @return string
     */
    public function repositoryClass(): string
    {
        return WarehouseRepository::class;
    }
}
