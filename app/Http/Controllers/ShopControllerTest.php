<?php

use App\Entities\Partner;
use App\Entities\Partner\Shop as PartnerShop;
use App\Entities\Shop;
use App\Http\Controllers\ShopController;
use App\Repositories\Partner\ShopRepository as PartnerShopRepository;
use App\Repositories\PartnerRepository;
use App\Repositories\ShopRepository;
use App\ViewModels\ShopCollection;
use Codeception\Specify;
use LaravelCommon\App\Entities\User;
use LaravelCommon\App\Entities\User\Token;
use LaravelCommon\App\Utilities\EntityUnit;
use LaravelCommon\Responses\BadRequestResponse;
use LaravelCommon\Responses\NoDataFoundResponse;
use LaravelCommon\Responses\ResourceCreatedResponse;
use LaravelCommon\Responses\SuccessResponse;
use LaravelCommon\System\Http\Request;
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
            $this->shopRepository = $this->prophesize(ShopRepository::class);
            $this->partnerRepository = $this->prophesize(PartnerRepository::class);
            $this->partnerShopRepository = $this->prophesize(PartnerShopRepository::class);
            $this->entityUnit = $this->prophesize(EntityUnit::class);

            $this->controller = new ShopController(
                $this->shopRepository->reveal(),
                $this->partnerRepository->reveal(),
                $this->partnerShopRepository->reveal(),
                $this->entityUnit->reveal()
            );
        });

        $this->describe('->getAll()', function () {
            $this->describe('when shopRepository has data', function () {

                $shop = (new Shop())
                    ->setId(1)
                    ->setName('shop1');

                $entityList = new EntityList([$shop]);
                $collection = new ShopCollection($entityList);


                $this->shopRepository->gather()
                    ->shouldBeCalled()
                    ->willReturn($collection);

                $result = $this->controller->getAll();

                verify($result)->instanceOf(SuccessResponse::class);
            });

            $this->describe('when shopRepository has no data', function () {

                $entityList = new EntityList([]);
                $collection = new ShopCollection($entityList);

                $this->shopRepository->gather()
                    ->shouldBeCalled()
                    ->willReturn($collection);

                $result = $this->controller->getAll();

                verify($result)->instanceOf(NoDataFoundResponse::class);
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

                    $partner = (new Partner())
                        ->setId(1)
                        ->setUser($user);

                    $request = (new Request())->setResource($shop);
                    $request->setUserToken($token);

                    $this->partnerRepository->getPartnerByUser($user)
                        ->shouldBeCalled()
                        ->willReturn(null);

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
                        ->setName('shop1');

                    $partner = (new Partner())
                        ->setId(1)
                        ->setUser($user);

                    $request = (new Request())->setResource($shop);
                    $request->setUserToken($token);

                    $this->partnerRepository->getPartnerByUser($user)
                        ->shouldBeCalled()
                        ->willReturn($partner);

                    $partnerShop = (new PartnerShop())
                        ->setId(1);

                    $this->partnerShopRepository->newEntity()
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
                    ->setName('shop1');

                $request = (new Request())->setResource($shop);

                $result = $this->controller->patch($request);
                verify($result)->instanceOf(SuccessResponse::class);
            });
        });

        $this->describe('->delete()', function () {
            $this->describe('will return SuccessResponse', function () {

                $shop = (new Shop())
                    ->setId(1)
                    ->setName('shop1');

                $request = (new Request())->setResource($shop);

                $result = $this->controller->delete($request);
                verify($result)->instanceOf(SuccessResponse::class);
            });
        });
    }
}
