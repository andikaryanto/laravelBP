<?php

use App\Entities\Warehouse;
use App\Http\Controllers\WarehouseController;
use App\Repositories\WarehouseRepository;
use App\ViewModels\WarehouseCollection;
use Codeception\Specify;
use LaravelCommon\Responses\NoDataFoundResponse;
use LaravelCommon\Responses\SuccessResponse;
use LaravelCommon\System\Http\Request;
use LaravelOrm\Entities\EntityList;
use Prophecy\PhpUnit\ProphecyTrait;
use Tests\TestCase;

class WarehouseControllerTest extends TestCase
{
    use Specify;
    use ProphecyTrait;


    /**
     * @var WarehouseController
     */
    private WarehouseController $controller;

    public function test()
    {
        $this->beforeSpecify(function () {
            $this->shopRepository =
                $this->prophesize(WarehouseRepository::class);

            $this->controller = new WarehouseController(
                $this->shopRepository->reveal()
            );
        });

        $this->describe('->getAll()', function () {
            $this->describe('when shopRepository has data', function () {

                $shop = (new Warehouse())
                    ->setId(1)
                    ->setName('shop1');

                $entityList = new EntityList([$shop]);
                $collection = new WarehouseCollection($entityList);


                $this->shopRepository->gather()
                    ->shouldBeCalled()
                    ->willReturn($collection);

                $result = $this->controller->getAll();

                verify($result)->instanceOf(SuccessResponse::class);
            });

            $this->describe('when shopRepository has no data', function () {

                $entityList = new EntityList([]);
                $collection = new WarehouseCollection($entityList);


                $this->shopRepository->gather()
                    ->shouldBeCalled()
                    ->willReturn($collection);

                $result = $this->controller->getAll();

                verify($result)->instanceOf(NoDataFoundResponse::class);
            });
        });

        $this->describe('->store()', function () {
            $this->describe('wil return SuccessResponse', function () {

                $shop = (new Warehouse())
                    ->setId(1)
                    ->setName('shop1');

                $request = (new Request())->setResource($shop);

                $result = $this->controller->get($request);
                verify($result)->instanceOf(SuccessResponse::class);
            });
        });

        $this->describe('->patch()', function () {
            $this->describe('wil return SuccessResponse', function () {

                $shop = (new Warehouse())
                    ->setId(1)
                    ->setName('shop1');

                $request = (new Request())->setResource($shop);

                $result = $this->controller->patch($request);
                verify($result)->instanceOf(SuccessResponse::class);
            });
        });

        $this->describe('->delete()', function () {
            $this->describe('wil return SuccessResponse', function () {

                $shop = (new Warehouse())
                    ->setId(1)
                    ->setName('shop1');

                $request = (new Request())->setResource($shop);

                $result = $this->controller->delete($request);
                verify($result)->instanceOf(SuccessResponse::class);
            });
        });
    }
}
