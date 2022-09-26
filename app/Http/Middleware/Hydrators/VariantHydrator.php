<?php

namespace App\Http\Middleware\Hydrators\Product;

use App\Repositories\Product\VariantRepository;
use LaravelCommon\App\Http\Middleware\Hydrator;

class VariantHydrator extends Hydrator
{
    public const NAME = 'hydrator.product-variant';

    /**
     *
     * @return string
     */
    public function repositoryClass(): string
    {
        return VariantRepository::class;
    }

    /**
     * @inheritDoc
     */
    public function getKey(): string
    {
        return 'product-variant';
    }
}
