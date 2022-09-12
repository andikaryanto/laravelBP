<?php

use App\Entities\Partner;
use App\Entities\Partner\ShopMapping;
use App\Entities\Shop;
use App\Http\Controllers\ShopController;
use App\Queries\ShopQuery;
use App\Repositories\Partner\ShopMappingRepository;
use App\System\Http\Request;
use App\ViewModels\ShopCollection;
use Codeception\Specify;
use LaravelCommon\App\Entities\User;
use LaravelCommon\App\Entities\User\Token;
use LaravelCommon\App\Utilities\EntityUnit;
use LaravelCommon\Responses\BadRequestResponse;
use LaravelCommon\Responses\NoDataFoundResponse;
use LaravelCommon\Responses\PagedJsonResponse;
use LaravelCommon\Responses\ResourceCreatedResponse;
use LaravelCommon\Responses\SuccessResponse;
use LaravelOrm\Entities\EntityList;
use Prophecy\PhpUnit\ProphecyTrait;
use Tests\TestCase;

class ShopControllerTest extends TestCase
{
    use Specify;
    use ProphecyTrait;


    /**
     * @var ShopController
     */
    private ShopController $controller;

    public function test()
    {
        $this->beforeSpecify(function () {
            $this->shopQuery = $this->prophesize(ShopQuery::class);
            $this->shopMappingRepository = $this->prophesize(ShopMappingRepository::class);
            $this->entityUnit = $this->prophesize(EntityUnit::class);

            $this->controller = new ShopController(
                $this->shopQuery->reveal(),
                $this->shopMappingRepository->reveal(),
                $this->entityUnit->reveal()
            );
        });

        $this->describe('->getAll()', function () {
            $this->describe('when shopRepository has data', function () {
                $this->describe('should return PagedJsonResponse', function () {

                    $shop = (new Shop())
                        ->setId(1)
                        ->setAddress('Address')
                        ->setPhone('098997')
                        ->setLongitude('110.21312312')
                        ->setLatitude('-7.5476657');

                    $entityList = new EntityList([$shop]);
                    $collection = new ShopCollection($entityList);

                    $this->shopQuery->getIterator()
                        ->shouldBeCalled()
                        ->willReturn($collection);

                    $this->shopQuery->getPagedCollection()
                        ->shouldBeCalled();

                    $this->shopQuery->getPagedCollection()
                        ->shouldBeCalled();

                    $result = $this->controller->getAll();

                    verify($result)->instanceOf(PagedJsonResponse::class);
                });
            });

            $this->describe('when shopRepository has no data', function () {
                $this->describe('should return NoDataFoundResponse', function () {

                    $entityList = new EntityList([]);
                    $collection = new ShopCollection($entityList);

                    $this->shopQuery->getIterator()
                        ->shouldBeCalled()
                        ->willReturn($collection);

                    $this->shopQuery->getPagedCollection()
                        ->shouldBeCalled();

                    $this->shopQuery->getPagedCollection()
                        ->shouldNotBeCalled();

                    $result = $this->controller->getAll();

                    verify($result)->instanceOf(NoDataFoundResponse::class);
                });
            });
        });

        $this->describe('->store()', function () {
            $this->describe('when user is not a partner', function () {
                $this->describe('will return BadRequestResponse', function () {

                    $user = (new User())
                        ->setId(1);

                    $token = (new Token())
                        ->setId(1)
                        ->setUser($user);

                    $shop = (new Shop())
                        ->setId(1)
                        ->setName('shop1');

                    $request = (new Request())->setResource($shop);
                    $request->setUserToken($token);

                    $result = $this->controller->store($request);
                    verify($result)->instanceOf(BadRequestResponse::class);
                    verify($result->getMessage())->equals('User is not a partner.');
                });
            });

            $this->describe('when user is a partner', function () {
                $this->describe('will return ResourceCreatedResponse', function () {

                    $user = (new User())
                        ->setId(1);

                    $token = (new Token())
                        ->setId(1)
                        ->setUser($user);

                    $shop = (new Shop())
                        ->setId(1)
                        ->setAddress('Address')
                        ->setPhone('098997')
                        ->setLongitude('110.21312312')
                        ->setLatitude('-7.5476657');

                    $partner = (new Partner())
                        ->setId(1)
                        ->setUser($user);

                    $request = (new Request())->setResource($shop);
                    $request->setUserToken($token);
                    $request->setPartner($partner);

                    $partnerShop = (new ShopMapping())
                        ->setId(1);

                    $this->shopMappingRepository->newEntity()
                        ->shouldBeCalled()
                        ->willReturn($partnerShop);

                    $this->entityUnit->preparePersistence($shop)->shouldBeCalled();
                    $this->entityUnit->preparePersistence($partnerShop)->shouldBeCalled();
                    $this->entityUnit->flush()->shouldBeCalled();

                    $result = $this->controller->store($request);
                    verify($result)->instanceOf(ResourceCreatedResponse::class);
                    verify($result->getMessage())->equals('OK');
                });
            });
        });

        $this->describe('->patch()', function () {
            $this->describe('will return SuccessResponse', function () {

                $shop = (new Shop())
                    ->setId(1)
                    ->setAddress('Address')
                    ->setPhone('098997')
                    ->setLongitude('110.21312312')
                    ->setLatitude('-7.5476657');

                $request = (new Request())->setResource($shop);

                $result = $this->controller->patch($request);
                verify($result)->instanceOf(SuccessResponse::class);
            });
        });

        $this->describe('->delete()', function () {
            $this->describe('will return SuccessResponse', function () {

                $shop = (new Shop())
                    ->setId(1)
                    ->setAddress('Address')
                    ->setPhone('098997')
                    ->setLongitude('110.21312312')
                    ->setLatitude('-7.5476657');

                $request = (new Request())->setResource($shop);

                $result = $this->controller->delete($request);
                verify($result)->instanceOf(SuccessResponse::class);
            });
        });
    }
}
