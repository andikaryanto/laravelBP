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
    protected CategoryRepository $CategoryRepository;

    /**
     * Undocumented variable
     *
     * @var EntityUnit
     */
    protected EntityUnit $entityUnit;

    /**
     * Undocumented function
     *
     * @param CategoryRepository $CategoryRepository
     * @param EntityUnit $entityUnit
     */
    public function __construct(
        CategoryRepository $CategoryRepository,
        EntityUnit $entityUnit
    ) {
        $this->CategoryRepository = $CategoryRepository;
        $this->entityUnit = $entityUnit;
    }


    /**
     * Get all paged Category
     *
     * @return void
     */
    public function getAll()
    {

        $Categorys = $this->CategoryRepository->gather();
        if ($Categorys->count() == 0) {
            return new NoDataFoundResponse('No Data Found', ResponseConst::NO_DATA_FOUND);
        }
        return (new SuccessResponse('OK', ResponseConst::OK, $Categorys));
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
            $partner = $request->getUserToken()->getUser()->partner;
            echo $partner->getId();
            $shop = $partner->getPartnerShops()->first()->getShop();
            $resource->setShop($shop);

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
