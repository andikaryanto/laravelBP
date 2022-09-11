<?php

namespace App\Http\Middleware\Hydrators\Product;

use App\Repositories\Product\CategoryRepository;
use LaravelCommon\App\Http\Middleware\Hydrator;

class CategoryHydrator extends Hydrator
{
    public const NAME = 'hydrator.product-category';

    /**
     *
     * @return string
     */
    public function repositoryClass(): string
    {
        return CategoryRepository::class;
    }

    /**
     * @inheritDoc
     */
    public function getKey(): string
    {
        return 'category';
    }
}
