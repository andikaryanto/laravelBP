<?php

namespace App\Http\Middleware\Hydrators;

use App\Repositories\ShopRepository;
use LaravelCommon\App\Http\Middleware\Hydrator;

class ShopHydrator extends Hydrator
{
    public const NAME = 'hydrator.shop';

    /**
     *
     * @return string
     */
    public function repositoryClass(): string
    {
        return ShopRepository::class;
    }
}
