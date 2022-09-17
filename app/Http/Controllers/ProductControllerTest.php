<?php

use App\Entities\Partner;
use App\Entities\Partner\ShopMapping;
use App\Entities\Product;
use App\Entities\Product\Category;
use App\Entities\Product\ProductCategoryMapping;
use App\Entities\Shop;
use App\Http\Controllers\ProductController;
use App\Queries\Product\CategoryQuery;
use App\Repositories\Product\ProductCategoryMappingRepository;
use App\Repositories\ProductRepository;
use App\System\Http\Request;
use App\ViewModels\ProductCollection;
use Codeception\Specify;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Http\UploadedFile;
use LaravelCommon\App\Entities\_Reserved\File;
use LaravelCommon\App\Entities\User;
use LaravelCommon\App\Entities\User\Token;
use LaravelCommon\App\Services\FileService;
use LaravelCommon\App\Utilities\EntityUnit;
use LaravelCommon\Responses\BadRequestResponse;
use LaravelCommon\Responses\NoDataFoundResponse;
use LaravelCommon\Responses\ResourceCreatedResponse;
use LaravelCommon\Responses\SuccessResponse;
use LaravelOrm\Entities\EntityList;
use Prophecy\PhpUnit\ProphecyTrait;
use Symfony\Component\HttpFoundation\FileBag;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use Specify;
    use ProphecyTrait;


    /**
     * @var ProductController
     */
    private ProductController $controller;

    public function test()
    {
        $this->beforeSpecify(function () {

            $this->user = (new User())
                ->setId(1);

            $this->shop = (new Shop())
                ->setId(1)
                ->setAddress('Address')
                ->setPhone('098997')
                ->setLongitude('110.21312312')
                ->setLatitude('-7.5476657');

            $this->shopMapping = (new ShopMapping())
                ->setId(1)
                ->setShop($this->shop);

            $this->partner = (new Partner())
                ->setId(1)
                ->setUser($this->user)
                ->setPartnerShops(new EntityList([$this->shopMapping]));

            $this->token = (new Token())
                ->setId(1)
                ->setUser($this->user);

            $this->product = (new Product())
                ->setId(1)
                ->setName('product1')
                ->setShop($this->shop);

            $this->category = (new Category())
                ->setId(1)
                ->setName('product1')
                ->setShop($this->shop);

            $this->productRepository =
                $this->prophesize(ProductRepository::class);
            $this->categoryQuery =
                $this->prophesize(CategoryQuery::class);
            $this->productCategoryMappingRepository =
                $this->prophesize(ProductCategoryMappingRepository::class);
            $this->fileService =
                $this->prophesize(FileService::class);
            $this->entityUnit =
                $this->prophesize(EntityUnit::class);

            $this->controller = new ProductController(
                $this->productRepository->reveal(),
                $this->categoryQuery->reveal(),
                $this->productCategoryMappingRepository->reveal(),
                $this->fileService->reveal(),
                $this->entityUnit->reveal()
            );
        });

        $this->describe('->getAll()', function () {
            $this->describe('when productRepository has data', function () {
                $entityList = new EntityList([$this->product]);
                $collection = new ProductCollection($entityList);


                $this->productRepository->gather()
                    ->shouldBeCalled()
                    ->willReturn($collection);

                $result = $this->controller->getAll();

                verify($result)->instanceOf(SuccessResponse::class);
            });

            $this->describe('when productRepository has no data', function () {

                $entityList = new EntityList([]);
                $collection = new ProductCollection($entityList);


                $this->productRepository->gather()
                    ->shouldBeCalled()
                    ->willReturn($collection);

                $result = $this->controller->getAll();

                verify($result)->instanceOf(NoDataFoundResponse::class);
            });
        });

        $this->describe('->store()', function () {
            $this->describe('has uploaded file', function () {
                $this->describe('should return ResourceCreatedResponse', function () {
                    $uplodedFiles[] = UploadedFile::fake()->image('images');

                    $this->entityUnit->preparePersistence($this->product)->shouldBeCalled();

                    $productCategoryMapping = new ProductCategoryMapping();

                    $this->categoryQuery->whereId(1)->shouldBeCalled()->willReturn($this->categoryQuery);
                    $this->categoryQuery->whereShop($this->shop)->shouldBeCalled()->willReturn($this->categoryQuery);
                    $this->categoryQuery->getFirstOrError()->shouldBeCalled()->willReturn($this->category);

                    $this->productCategoryMappingRepository->newEntity()
                        ->shouldBeCalled()
                        ->willReturn($productCategoryMapping);

                    $this->fileService->allowedFileTypes(['jpg', 'jpeg', 'png'])
                        ->shouldBeCalled()
                        ->willReturn($this->fileService);

                    $this->fileService->uploadBatch($uplodedFiles, 'product/')
                        ->shouldBeCalled()
                        ->willReturn($this->fileService);

                    $file = (new File())
                        ->setName('name')
                        ->setExtension('jpeg')
                        ->setSize(1000)
                        ->setMimeType('image/jpeg');

                    $this->fileService->getFiles()
                        ->shouldBeCalled()
                        ->willReturn($file);

                    $this->entityUnit->preparePersistence($productCategoryMapping)
                        ->shouldBeCalled();

                    $this->entityUnit->flush()->shouldBeCalled();

                    $request = new Request();
                    $request->setResource($this->product);
                    $request->setUserToken($this->token);
                    $request->setPartner($this->partner);
                    $request->category_ids = [1];
                    $request->files = new FileBag(['files' => $uplodedFiles]);

                    $result = $this->controller->store($request);
                    verify($result)->instanceOf(ResourceCreatedResponse::class);
                });
            });

            $this->describe('has no file upload', function () {
                $this->describe('will return BadRequestResponse', function () {
                    $request = (new Request())->setResource($this->product);
                    $request->setUserToken($this->token);
                    $request->setPartner($this->partner);
                    $request->category_ids = [1];

                    $result = $this->controller->store($request);
                    verify($result)->instanceOf(BadRequestResponse::class);
                });
            });
        });

        $this->describe('->patch()', function () {
            $this->describe('will return SuccessResponse', function () {
                $request = (new Request())->setResource($this->product);

                $result = $this->controller->patch($request);
                verify($result)->instanceOf(SuccessResponse::class);
            });
        });

        $this->describe('->delete()', function () {
            $this->describe('will return SuccessResponse', function () {
                $request = (new Request())->setResource($this->product);

                $result = $this->controller->delete($request);
                verify($result)->instanceOf(SuccessResponse::class);
            });
        });
    }
}
