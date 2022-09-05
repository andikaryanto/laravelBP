<?php

namespace App\Http\Middleware\Hydrators;

use App\Entities\Warehouse;
use App\Repositories\WarehouseRepository;
use LaravelCommon\App\Http\Middleware\Hydrator;

class WarehouseHydrator extends Hydrator
{
    public const NAME = 'hydrator.warehouse';

    /**
     *
     * @return string
     */
    public function repositoryClass(): string
    {
        return WarehouseRepository::class;
    }
}
