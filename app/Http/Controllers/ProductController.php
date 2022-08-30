<?php

namespace App\Http\Controllers;

use App\Repositories\ProductRepository;
use App\ViewModels\ProductViewModel;
use Exception;
use Illuminate\Http\Request;
use LaravelCommon\App\Consts\ResponseConst;
use LaravelCommon\App\Utilities\EntityUnit;
use LaravelCommon\Responses\NoDataFoundResponse;
use LaravelCommon\Responses\ResourceCreatedResponse;
use LaravelCommon\Responses\ServerErrorResponse;
use LaravelCommon\Responses\SuccessResponse;

class ProductController extends Controller
{
    /**
     * Undocumented variable
     *
     * @var ProductRepository
     */
    protected ProductRepository $productRepository;

    /**
     * Undocumented variable
     *
     * @var EntityUnit
     */
    protected EntityUnit $entityUnit;

    /**
     * Undocumented function
     *
     * @param ProductRepository $productRepository
     * @param EntityUnit $entityUnit
     */
    public function __construct(
        ProductRepository $productRepository,
        EntityUnit $entityUnit
    ) {
        $this->productRepository = $productRepository;
        $this->entityUnit = $entityUnit;
    }


    /**
     * Get all paged product
     *
     * @return void
     */
    public function getAll()
    {

        $products = $this->productRepository->gather();
        if ($products->count() == 0) {
            return new NoDataFoundResponse('No Data Found', ResponseConst::NO_DATA_FOUND);
        }
        return (new SuccessResponse('OK', ResponseConst::OK, $products));
    }

    /**
     * Get product by id
     *
     * @param Request $request
     * @return void
     */
    public function get(Request $request)
    {
        $resource = $request->getResource();
        return new SuccessResponse('OK', ResponseConst::OK, new ProductViewModel($resource));
    }

    /**
     * Save new ware house, see entity-unit middleware, persistence happens there
     *
     * @return SuccessResponse|ServerErrorResponse
     */
    public function store(Request $request)
    {
        try {
            $product = $request->getResource();
            $partner = $request->getUserToken()->getUser()->partner;
            $shop = $partner->getPartnerShops()->first()->getShop();
            $product->setShop($shop);

            $this->entityUnit->preparePersistence($product);
            $this->entityUnit->flush();

            return new ResourceCreatedResponse('OK', ResponseConst::OK, new ProductViewModel($product));
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

            return new SuccessResponse('OK', ResponseConst::OK, new ProductViewModel($resource));
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

            return new SuccessResponse('OK', ResponseConst::OK, new ProductViewModel($resource));
        } catch (Exception $e) {
            return new ServerErrorResponse($e->getMessage());
        }
    }
}
