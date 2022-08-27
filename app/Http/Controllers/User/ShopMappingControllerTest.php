<?php

use App\Entities\Shop;
use App\Entities\User\ShopMapping;
use App\Http\Controllers\User\ShopMappingController;
use App\Repositories\ShopRepository;
use App\Repositories\User\ShopMappingRepository;
use Codeception\Specify;
use LaravelCommon\App\Entities\User;
use LaravelCommon\App\Repositories\UserRepository;
use LaravelCommon\App\Utilities\EntityUnit;
use LaravelCommon\Responses\BadRequestResponse;
use LaravelCommon\Responses\ResourceCreatedResponse;
use LaravelCommon\Responses\SuccessResponse;
use LaravelCommon\System\Http\Request;
use Prophecy\PhpUnit\ProphecyTrait;
use Tests\TestCase;

class ShopMappingControllerTest extends TestCase
{
    use Specify;
    use ProphecyTrait;


    /**
     * @var ShopMappingController
     */
    private ShopMappingController $controller;

    public function test()
    {
        $this->beforeSpecify(function () {
            $this->userRepository =
                $this->prophesize(UserRepository::class);
            $this->shopRepository =
                $this->prophesize(ShopRepository::class);
            $this->shopMappingRepository =
                $this->prophesize(ShopMappingRepository::class);
            $this->entityUnit =
                $this->prophesize(EntityUnit::class);

            $this->shop1 = (new Shop())
                ->setId(1)
                ->setName('shop1');

            $this->request = (new Request());
            $this->request->shop_id = 1;
            $this->request->username = 'andik';
            $this->request->email = 'andik.aryanto';
            $this->request->password = 'P@ssword1';

            $this->controller = new ShopMappingController(
                $this->userRepository->reveal(),
                $this->shopRepository->reveal(),
                $this->shopMappingRepository->reveal(),
                $this->entityUnit->reveal()
            );
        });

        $this->describe('->register()', function () {
            $this->describe('when email is not valid', function () {
                $this->userRepository->newEntity()
                    ->shouldBeCalled()
                    ->willReturn(new User());

                $this->shopRepository->findOrFail($this->request->shop_id)
                    ->shouldBeCalled()
                    ->willReturn($this->shop1);

                $result = $this->controller->register($this->request);

                verify($result)->instanceOf(BadRequestResponse::class);
                verify($result->getMessage())->equals('The email must be a valid email address.');
                verify($result->getStatusCode())->equals(400);
            });
            
            $this->describe('when email is valid', function () {
                $this->request->email = 'andik.aryanto@gmail.com';

                $user = new User();
                $userShopMapping = new ShopMapping();

                $this->userRepository->newEntity()
                    ->shouldBeCalled()
                    ->willReturn($user);

                $this->entityUnit->preparePersistence($user)->shouldBeCalled();

                $this->shopRepository->findOrFail($this->request->shop_id)
                    ->shouldBeCalled()
                    ->willReturn($this->shop1);

                $this->shopMappingRepository->newEntity()
                    ->shouldBeCalled()
                    ->willReturn($userShopMapping);

                $this->entityUnit->preparePersistence($userShopMapping)->shouldBeCalled();
                $this->entityUnit->flush()->shouldBeCalled();

                $result = $this->controller->register($this->request);

                verify($result)->instanceOf(ResourceCreatedResponse::class);
                verify($result->getStatusCode())->equals(201);
            });
        });

        $this->describe('->get()', function () {
            $this->describe('will return SuccessResponse', function () {

                $user = (new User())
                    ->setId(1);

                $request = (new Request())->setResource($user);

                $result = $this->controller->get($request);
                verify($result)->instanceOf(SuccessResponse::class);
            });
        });

        $this->describe('->delete()', function () {
            $this->describe('will return SuccessResponse', function () {

                $user = (new User())
                    ->setId(1);

                $request = (new Request())->setResource($user);

                $result = $this->controller->delete($request);
                verify($result)->instanceOf(SuccessResponse::class);
            });
        });
            
    }
}
