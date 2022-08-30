<?php

namespace App\Http\Middleware\Hydrators;

use App\Repositories\ProductRepository;
use LaravelCommon\App\Http\Middleware\Hydrator;

class ProductHydrator extends Hydrator
{
    /**
     *
     * @return string
     */
    public function repositoryClass(): string
    {
        return ProductRepository::class;
    }
}
