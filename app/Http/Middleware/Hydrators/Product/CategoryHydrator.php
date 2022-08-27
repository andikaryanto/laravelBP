<?php

namespace App\Http\Middleware\Hydrators\Product;

use App\Repositories\Product\CategoryRepository;
use LaravelCommon\App\Http\Middleware\Hydrator;

class CategoryHydrator extends Hydrator
{
    /**
     *
     * @return string
     */
    public function repositoryClass(): string
    {
        return CategoryRepository::class;
    }
}
