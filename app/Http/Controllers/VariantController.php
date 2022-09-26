<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Queries\Product\CategoryQuery;
use App\Queries\Product\VariantQuery;
use App\Repositories\Product\CategoryRepository;
use App\Repositories\Product\VariantRepository;
use App\Repositories\ProductRepository;
use App\ViewModels\Product\CategoryViewModel;
use Exception;
use Illuminate\Http\Request;
use LaravelCommon\App\Consts\ResponseConst;
use LaravelCommon\App\Utilities\EntityUnit;
use LaravelCommon\Responses\NoDataFoundResponse;
use LaravelCommon\Responses\PagedJsonResponse;
use LaravelCommon\Responses\ResourceCreatedResponse;
use LaravelCommon\Responses\ServerErrorResponse;
use LaravelCommon\Responses\SuccessResponse;

class VariantController extends Controller
{
    /**
     * Undocumented variable
     *
     * @var VariantQuery
     */
    protected VariantQuery $variantQuery;

    /**
     * Undocumented variable
     *
     * @var ProductRepository
     */
    protected ProductRepository $productRepository;

    /**
     * Undocumented function
     *
     * @param VariantQuery $variantRepository
     * @param ProductRepository $productRepository
     */
    public function __construct(
        VariantQuery $variantQuery,
        ProductRepository $productRepository
    ) {
        $this->variantQuery = $variantQuery;
        $this->productRepository = $productRepository;
    }

    /**
     * Get variants of a product
     *
     * @param Request $request
     * @return void
     */
    public function getProductVariant(Request $request)
    {

        $product = $request->getResource();
        $variants = $this->variantQuery->whereProduct($product);

        if ($variants->getIterator()->count() == 0) {
            return new NoDataFoundResponse('No Data Found', ResponseConst::NO_DATA_FOUND);
        }
        return (new PagedJsonResponse('OK', ResponseConst::OK, $variants));
    }

    public function store(Request $request)
    {
        try {
            $resource = $request->getResource();
            $product = $this->prod
        } catch (Exception $e) {
        }
    }
}
