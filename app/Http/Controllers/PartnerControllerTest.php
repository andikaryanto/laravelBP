<?php

use App\Entities\Partner;
use App\Http\Controllers\PartnerController;
use App\Repositories\PartnerRepository;
use Codeception\Specify;
use LaravelCommon\App\Entities\Scope;
use LaravelCommon\App\Entities\User;
use LaravelCommon\App\Entities\User\ScopeMapping;
use LaravelCommon\App\Repositories\ScopeRepository;
use LaravelCommon\App\Repositories\User\ScopeMappingRepository;
use LaravelCommon\App\Repositories\UserRepository;
use LaravelCommon\App\Utilities\EntityUnit;
use LaravelCommon\Responses\ResourceCreatedResponse;
use LaravelCommon\System\Http\Request;
use Prophecy\PhpUnit\ProphecyTrait;
use Tests\TestCase;

class PartnerControllerTest extends TestCase
{
    use Specify;
    use ProphecyTrait;


    /**
     * @var PartnerController
     */
    private PartnerController $controller;

    public function test()
    {
        $this->beforeSpecify(function () {
            $this->scopeRepository = $this->prophesize(ScopeRepository::class);
            $this->scopeMappingRepository = $this->prophesize(ScopeMappingRepository::class);
            $this->userRepository = $this->prophesize(UserRepository::class);
            $this->partnerRepository = $this->prophesize(PartnerRepository::class);
            $this->entityUnit = $this->prophesize(EntityUnit::class);

            $this->controller = new PartnerController(
                $this->scopeRepository->reveal(),
                $this->scopeMappingRepository->reveal(),
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

                $scope = (new Scope())
                    ->setId(1);

                $user = new User();
                $this->userRepository->newEntity()
                    ->shouldBeCalled()
                    ->willReturn($user);

                $this->entityUnit->preparePersistence($user)->shouldBeCalled();
                $this->scopeRepository->getScopeByName(PartnerController::PARTNER_SCOPE_NAME)
                    ->shouldBeCalled()
                    ->willReturn($scope);

                $partner = new Partner();
                $this->partnerRepository->newEntity()
                    ->shouldBeCalled()
                    ->willReturn($partner);
                $this->entityUnit->preparePersistence($partner)->shouldBeCalled();

                $scopeMapping = (new ScopeMapping())
                    ->setId(1);

                $this->scopeMappingRepository->newEntity()
                    ->shouldBeCalled()
                    ->willReturn($scopeMapping);
                $this->entityUnit->preparePersistence($scopeMapping)->shouldBeCalled();

                $this->entityUnit->flush()->shouldBeCalled();

                $result = $this->controller->register($request);
                verify($result)->instanceOf(ResourceCreatedResponse::class);
            });
        });
    }
}
