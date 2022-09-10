<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Repositories\Product\CategoryRepository;
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

class CategoryController extends Controller
{
    /**
     * Undocumented variable
     *
     * @var CategoryRepository
     */
    protected CategoryRepository $categoryRepository;

    /**
     * Undocumented function
     *
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(
        CategoryRepository $categoryRepository
    ) {
        $this->categoryRepository = $categoryRepository;
    }


    /**
     * Get all paged Category
     *
     * @return void
     */
    public function getAll(Request $request)
    {
        $shop = $request->getPartnerShop();
        $filter = [
            'where' => [
                ['shop_id', '=', $shop->getId()]
            ]
        ];
        $categories = $this->categoryRepository->addFilters($filter);
        if ($categories->count() == 0) {
            return new NoDataFoundResponse('No Data Found', ResponseConst::NO_DATA_FOUND);
        }
        return (new PagedJsonResponse('OK', ResponseConst::OK, $categories));
    }

    public function get(Request $request)
    {
        $resource = $request->getResource();
        return new SuccessResponse('OK', ResponseConst::OK, new CategoryViewModel($resource));
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

            return new ResourceCreatedResponse('OK', ResponseConst::OK, new CategoryViewModel($resource));
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

            return new SuccessResponse('OK', ResponseConst::OK, new CategoryViewModel($resource));
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

            return new SuccessResponse('OK', ResponseConst::OK, new CategoryViewModel($resource));
        } catch (Exception $e) {
            return new ServerErrorResponse($e->getMessage());
        }
    }
}
