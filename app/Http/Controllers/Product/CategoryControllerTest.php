<?php

use App\Entities\Partner;
use App\Entities\Partner\ShopMapping;
use App\Entities\Product\Category;
use App\Entities\Shop;
use App\Http\Controllers\Product\CategoryController;
use App\Repositories\Product\CategoryRepository;
use App\System\Http\Request;
use App\ViewModels\Product\CategoryCollection;
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

class CategoryControllerTest extends TestCase
{
    use Specify;
    use ProphecyTrait;


    /**
     * @var CategoryController
     */
    private CategoryController $controller;

    public function test()
    {
        $this->beforeSpecify(function () {
            $this->categoryRepository =
                $this->prophesize(CategoryRepository::class);
            $this->entityUnit =
                $this->prophesize(EntityUnit::class);

            $this->controller = new CategoryController(
                $this->categoryRepository->reveal(),
                $this->entityUnit->reveal()
            );
        });

        $this->describe('->getAll()', function () {
            $this->describe('when categoryRepository has data', function () {

                $category = (new Category())
                    ->setId(1)
                    ->setName('category1');

                $entityList = new EntityList([$category]);
                $collection = new CategoryCollection($entityList);


                $this->categoryRepository->gather()
                    ->shouldBeCalled()
                    ->willReturn($collection);

                $result = $this->controller->getAll();

                verify($result)->instanceOf(SuccessResponse::class);
            });

            $this->describe('when categoryRepository has no data', function () {

                $entityList = new EntityList([]);
                $collection = new CategoryCollection($entityList);


                $this->categoryRepository->gather()
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

                $category = (new Category())
                    ->setId(1)
                    ->setName('category1')
                    ->setShop($shop);

                $this->entityUnit->preparePersistence($category)->shouldBeCalled();
                $this->entityUnit->flush()->shouldBeCalled();

                $request = (new Request())->setResource($category);
                $request->setUserToken($token);
                $request->setPartner($partner);


                $result = $this->controller->store($request);
                verify($result)->instanceOf(ResourceCreatedResponse::class);
            });
        });

        $this->describe('->patch()', function () {
            $this->describe('will return SuccessResponse', function () {

                $category = (new Category())
                    ->setId(1)
                    ->setName('category1');

                $request = (new Request())->setResource($category);

                $result = $this->controller->patch($request);
                verify($result)->instanceOf(SuccessResponse::class);
            });
        });

        $this->describe('->delete()', function () {
            $this->describe('will return SuccessResponse', function () {

                $category = (new Category())
                    ->setId(1)
                    ->setName('category1');

                $request = (new Request())->setResource($category);

                $result = $this->controller->delete($request);
                verify($result)->instanceOf(SuccessResponse::class);
            });
        });
    }
}
