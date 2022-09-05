<?php

namespace App\Repositories\Product;

use App\Entities\Product\ProductCategoryMapping;
use App\ViewModels\Product\ProductCategoryMappingCollection;
use App\ViewModels\Product\ProductCategoryMappingViewModel;
use LaravelCommon\App\Repositories\BaseRepository;

class ProductCategoryMappingRepository extends BaseRepository implements ProductCategoryMappingRepositoryInterface
{
    /**
    * Constrcutor
    */
    public function __construct()
    {
        parent::__construct(ProductCategoryMapping::class);
    }

    /**
     * @inheritDoc
     *
     * @return string
     */
    public function collectionClass(): string
    {
        return ProductCategoryMappingCollection::class;
    }

    /**
     * @inheritDoc
     *
     * @return stirng
     */
    public function viewModelClass(): string
    {
        return ProductCategoryMappingViewModel::class;
    }
}
