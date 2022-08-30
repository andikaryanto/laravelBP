<?php

namespace App\Repositories;

use App\Entities\Product;
use App\Repositories\ProductRepositoryInterface;
use App\ViewModels\ProductCollection;
use App\ViewModels\ProductViewModel;
use Exception;
use LaravelCommon\App\Repositories\BaseRepository;
use LaravelOrm\Exception\EntityException;
use LaravelOrm\Interfaces\IEntity;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    /**
    * Constrcutor
    */
    public function __construct()
    {
        parent::__construct(Product::class);
    }

    /**
     * @inheritDoc
     *
     * @return string
     */
    public function collectionClass(): string
    {
        return ProductCollection::class;
    }

    /**
     * @inheritDoc
     *
     * @return stirng
     */
    public function viewModelClass(): string
    {
        return ProductViewModel::class;
    }
}
