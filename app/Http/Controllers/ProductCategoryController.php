<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Queries\ProductCategoryQuery;
use App\ViewModels\ProductCategoryViewModel;
use Exception;
use Illuminate\Http\Request;
use LaravelCommon\App\Consts\ResponseConst;
use LaravelCommon\Responses\NoDataFoundResponse;
use LaravelCommon\Responses\PagedJsonResponse;
use LaravelCommon\Responses\ResourceCreatedResponse;
use LaravelCommon\Responses\ServerErrorResponse;
use LaravelCommon\Responses\SuccessResponse;

class ProductCategoryController extends Controller
{
    /**
     * Undocumented variable
     *
     * @var ProductCategoryQuery
     */
    protected ProductCategoryQuery $productCategoryQuery;

    /**
     * Undocumented function
     *
     * @param ProductCategoryQuery $categoryRepository
     */
    public function __construct(
        ProductCategoryQuery $productCategoryQuery
    ) {
        $this->productCategoryQuery = $productCategoryQuery;
    }


    /**
     * Get all paged Category
     *
     * @return void
     */
    public function getAll(Request $request)
    {
        $shop = $request->getPartnerShop();
        $categories = $this->productCategoryQuery->whereShop($shop);
        if ($categories->getIterator()->count() == 0) {
            return new NoDataFoundResponse('No Data Found', ResponseConst::NO_DATA_FOUND);
        }
        return (new PagedJsonResponse('OK', ResponseConst::OK, $categories));
    }

    public function get(Request $request)
    {
        $resource = $request->getResource();
        return new SuccessResponse('OK', ResponseConst::OK, new ProductCategoryViewModel($resource));
    }

    /**
     * Save new ware house, see entity-unit middleware, persistence happens there
     *
     * @return ResourceCreatedResponse|ServerErrorResponse
     */
    public function store(Request $request)
    {
        try {
            $resource = $request->getResource();

            return new ResourceCreatedResponse('OK', ResponseConst::OK, new ProductCategoryViewModel($resource));
        } catch (Exception $e) {
            return new ServerErrorResponse($e->getMessage());
        }
    }

    /**
     * patch a column of entity
     *
     * @return SuccessResponse|ServerErrorResponse
     */
    public function patch(Request $request)
    {
        try {
            $resource = $request->getResource();

            return new SuccessResponse('OK', ResponseConst::OK, new ProductCategoryViewModel($resource));
        } catch (Exception $e) {
            return new ServerErrorResponse($e->getMessage());
        }
    }

    /**
     * patch a column of entity
     *
     * @return SuccessResponse|ServerErrorResponse
     */
    public function delete(Request $request)
    {
        try {
            $resource = $request->getResource();

            return new SuccessResponse('OK', ResponseConst::OK, new ProductCategoryViewModel($resource));
        } catch (Exception $e) {
            return new ServerErrorResponse($e->getMessage());
        }
    }
}
