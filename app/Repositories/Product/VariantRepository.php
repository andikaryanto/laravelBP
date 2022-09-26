<?php

namespace App\Repositories\Product;

use App\Entities\Product\Variant;
use App\ViewModels\Product\VariantCollection;
use App\ViewModels\Product\VariantViewModel;
use LaravelCommon\App\Repositories\Repository;

class VariantRepository extends Repository implements VariantRepositoryInterface
{
    /**
    * Constrcutor
    */
    public function __construct()
    {
        parent::__construct(Variant::class);
    }

    /**
     * @inheritDoc
     *
     * @return string
     */
    public function collectionClass(): string
    {
        return VariantCollection::class;
    }

    /**
     * @inheritDoc
     *
     * @return stirng
     */
    public function viewModelClass(): string
    {
        return VariantViewModel::class;
    }
}
