<?php

use App\Entities\Partner;
use App\Entities\Partner\ShopMapping;
use App\Entities\Product;
use App\Entities\Shop;
use App\Http\Controllers\ProductController;
use App\Repositories\ProductRepository;
use App\System\Http\Request;
use App\ViewModels\ProductCollection;
use Codeception\Specify;
use LaravelCommon\App\Entities\User;
use LaravelCommon\App\Entities\User\Token;
use LaravelCommon\App\Utilities\EntityUnit;
use LaravelCommon\Responses\NoDataFoundResponse;
use LaravelCommon\Responses\ResourceCreatedResponse;
use LaravelCommon\Responses\SuccessResponse;
use LaravelOrm\Entities\EntityList;
use Prophecy\PhpUnit\ProphecyTrait;
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
            $this->productRepository =
                $this->prophesize(ProductRepository::class);
            $this->entityUnit =
                $this->prophesize(EntityUnit::class);

            $this->controller = new ProductController(
                $this->productRepository->reveal(),
                $this->entityUnit->reveal()
            );
        });

        $this->describe('->getAll()', function () {
            $this->describe('when productRepository has data', function () {

                $product = (new Product())
                    ->setId(1)
                    ->setName('product1');

                $entityList = new EntityList([$product]);
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
            $this->describe('will return ResourceCreatedResponse', function () {


                $user = (new User())
                    ->setId(1);

                $shop = (new Shop())
                    ->setId(1);

                $shopMapping = (new ShopMapping())
                    ->setId(1)
                    ->setShop($shop);

                $partner = (new Partner())
                    ->setId(1)
                    ->setUser($user)
                    ->setPartnerShops(new EntityList([$shopMapping]));

                $token = (new Token())
                    ->setId(1)
                    ->setUser($user);

                $product = (new Product())
                    ->setId(1)
                    ->setName('product1')
                    ->setShop($shop);

                $this->entityUnit->preparePersistence($product)->shouldBeCalled();
                $this->entityUnit->flush()->shouldBeCalled();

                $request = (new Request())->setResource($product);
                $request->setUserToken($token);
                $request->setPartner($partner);


                $result = $this->controller->store($request);
                verify($result)->instanceOf(ResourceCreatedResponse::class);
            });
        });

        $this->describe('->patch()', function () {
            $this->describe('will return SuccessResponse', function () {

                $product = (new Product())
                    ->setId(1)
                    ->setName('product1');

                $request = (new Request())->setResource($product);

                $result = $this->controller->patch($request);
                verify($result)->instanceOf(SuccessResponse::class);
            });
        });

        $this->describe('->delete()', function () {
            $this->describe('will return SuccessResponse', function () {

                $product = (new Product())
                    ->setId(1)
                    ->setName('product1');

                $request = (new Request())->setResource($product);

                $result = $this->controller->delete($request);
                verify($result)->instanceOf(SuccessResponse::class);
            });
        });
    }
}
