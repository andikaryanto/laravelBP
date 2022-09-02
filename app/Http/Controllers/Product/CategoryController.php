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
     * Undocumented variable
     *
     * @var EntityUnit
     */
    protected EntityUnit $entityUnit;

    /**
     * Undocumented function
     *
     * @param CategoryRepository $categoryRepository
     * @param EntityUnit $entityUnit
     */
    public function __construct(
        CategoryRepository $categoryRepository,
        EntityUnit $entityUnit
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->entityUnit = $entityUnit;
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
        $categories = $this->categoryRepository->gather($filter);
        if ($categories->count() == 0) {
            return new NoDataFoundResponse('No Data Found', ResponseConst::NO_DATA_FOUND);
        }
        return (new SuccessResponse('OK', ResponseConst::OK, $categories));
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

            $this->entityUnit->preparePersistence($resource);
            $this->entityUnit->flush();

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
