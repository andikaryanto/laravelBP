<?php

namespace App\Http\Controllers;

use App\Entities\Product\File;
use App\Queries\Product\CategoryQuery;
use App\Repositories\Product\CategoryRepository;
use App\Repositories\Product\ProductCategoryMappingRepository;
use App\Repositories\ProductRepository;
use App\ViewModels\ProductViewModel;
use Exception;
use Illuminate\Http\Request;
use LaravelCommon\App\Consts\ResponseConst;
use LaravelCommon\App\Services\FileService;
use LaravelCommon\App\Utilities\EntityUnit;
use LaravelCommon\Responses\BadRequestResponse;
use LaravelCommon\Responses\NoDataFoundResponse;
use LaravelCommon\Responses\ResourceCreatedResponse;
use LaravelCommon\Responses\ServerErrorResponse;
use LaravelCommon\Responses\SuccessResponse;
use LaravelOrm\Exception\DatabaseException;
use LaravelOrm\Exception\EntityException;

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
     * @var CategoryQuery
     */
    protected CategoryQuery $categoryQuery;

    /**
     * Undocumented variable
     *
     * @var ProductCategoryMappingRepository
     */
    protected ProductCategoryMappingRepository $productCategoryMappingRepository;

    /**
     * Undocumented variable
     *
     * @var FileService
     */
    protected FileService $fileService;

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
     * @param CategoryQuery $categoryQuery
     * @param ProductCategoryMappingRepository $productCategoryMappingRepository
     * @param FileService $fileService
     * @param EntityUnit $entityUnit
     */
    public function __construct(
        ProductRepository $productRepository,
        CategoryQuery $categoryQuery,
        ProductCategoryMappingRepository $productCategoryMappingRepository,
        FileService $fileService,
        EntityUnit $entityUnit
    ) {
        $this->productRepository = $productRepository;
        $this->categoryQuery = $categoryQuery;
        $this->productCategoryMappingRepository = $productCategoryMappingRepository;
        $this->fileService = $fileService;
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
            if (!$request->hasFile('files')) {
                return new BadRequestResponse('Files is required.');
            }

            $categoryIds = $request->category_ids;
            $shop = $request->getPartnerShop();

            $product = $request->getResource();
            $product->setShop($shop);
            $this->entityUnit->preparePersistence($product);

            foreach ($categoryIds as $categoryId) {
                $category = $this->categoryQuery
                    ->whereId($categoryId)
                    ->whereShop($shop)
                    ->getFirstOrError();

                $productProductCategoryMapping = $this->productCategoryMappingRepository->newEntity();
                $productProductCategoryMapping->setProduct($product);
                $productProductCategoryMapping->setProductCategory($category);
                $this->entityUnit->preparePersistence($productProductCategoryMapping);
            }

            /**
             * @var \Illuminate\Http\UploadedFile[]
             */
            $productsFiles = $request->file('files');

            foreach ($productsFiles as $productFile) {
                $pathName = $this->fileService->upload($productFile, 'product/');

                $extension = $productFile->getClientOriginalExtension();
                $size = $productFile->getSize();
                $type = $productFile->getMimeType();

                $productFile = new File();
                $productFile->setProduct($product);
                $productFile->setName($pathName);
                $productFile->setExtension($extension);
                $productFile->setType($type);
                $productFile->setSize($size);
                $this->entityUnit->preparePersistence($productFile);
            }

            $this->entityUnit->flush();

            return new ResourceCreatedResponse('OK', ResponseConst::OK, new ProductViewModel($product));
        } catch (EntityException $e) {
            return new BadRequestResponse($e->getMessage(), ResponseConst::INVALID_DATA);
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
