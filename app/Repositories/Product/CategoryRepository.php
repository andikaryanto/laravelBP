<?php

namespace App\Repositories\Product;

use App\Entities\Product\Category;
use App\ViewModels\Product\CategoryCollection;
use App\ViewModels\Product\CategoryViewModel;
use LaravelCommon\App\Repositories\Repository;

class CategoryRepository extends Repository implements CategoryRepositoryInterface
{
    /**
    * Constrcutor
    */
    public function __construct()
    {
        parent::__construct(Category::class);
    }

    /**
     * @inheritDoc
     *
     * @return string
     */
    public function collectionClass(): string
    {
        return CategoryCollection::class;
    }

    /**
     * @inheritDoc
     *
     * @return stirng
     */
    public function viewModelClass(): string
    {
        return CategoryViewModel::class;
    }
}
