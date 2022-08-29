<?php

use App\Entities\Partner;
use App\Http\Controllers\UserController;
use App\Repositories\PartnerRepository;
use Codeception\Specify;
use LaravelCommon\App\Entities\User;
use LaravelCommon\App\Repositories\UserRepository;
use LaravelCommon\App\Utilities\EntityUnit;
use LaravelCommon\Responses\ResourceCreatedResponse;
use LaravelCommon\Responses\SuccessResponse;
use LaravelCommon\System\Http\Request;
use Prophecy\PhpUnit\ProphecyTrait;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use Specify;
    use ProphecyTrait;


    /**
     * @var UserController
     */
    private UserController $controller;

    public function test()
    {
        $this->beforeSpecify(function () {
            $this->userRepository = $this->prophesize(UserRepository::class);
            $this->partnerRepository = $this->prophesize(PartnerRepository::class);
            $this->entityUnit = $this->prophesize(EntityUnit::class);

            $this->controller = new UserController(
                $this->userRepository->reveal(),
                $this->partnerRepository->reveal(),
                $this->entityUnit->reveal()
            );
        });

        $this->describe('->register()', function () {
            $this->describe('should return ResourceCreatedResponse', function () {


                $request = (new Request());
                $request->username = 'andik';
                $request->password = 'P@ssword';
                $request->email = 'email@email.com';

                $user = new User();
                $this->userRepository->newEntity()
                    ->shouldBeCalled()
                    ->willReturn($user);

                $this->entityUnit->preparePersistence($user)->shouldBeCalled();

                $partner = new Partner();
                $this->partnerRepository->newEntity()
                    ->shouldBeCalled()
                    ->willReturn($partner);
                $this->entityUnit->preparePersistence($partner)->shouldBeCalled();

                $this->entityUnit->flush()->shouldBeCalled();

                $result = $this->controller->register($request);
                verify($result)->instanceOf(ResourceCreatedResponse::class);
            });
        });
    }
}
