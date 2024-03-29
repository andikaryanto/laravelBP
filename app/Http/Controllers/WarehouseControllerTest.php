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
            $this->warehouseRepository =
                $this->prophesize(WarehouseRepository::class);

            $this->controller = new WarehouseController(
                $this->warehouseRepository->reveal()
            );
        });

        $this->describe('->getAll()', function () {
            $this->describe('when warehouseRepository has data', function () {

                $warehouse = (new Warehouse())
                    ->setId(1)
                    ->setName('warehouse1');

                $entityList = new EntityList([$warehouse]);
                $collection = new WarehouseCollection($entityList);


                $this->warehouseRepository->gather()
                    ->shouldBeCalled()
                    ->willReturn($collection);

                $result = $this->controller->getAll();

                verify($result)->instanceOf(SuccessResponse::class);
            });

            $this->describe('when warehouseRepository has no data', function () {

                $entityList = new EntityList([]);
                $collection = new WarehouseCollection($entityList);


                $this->warehouseRepository->gather()
                    ->shouldBeCalled()
                    ->willReturn($collection);

                $result = $this->controller->getAll();

                verify($result)->instanceOf(NoDataFoundResponse::class);
            });
        });

        $this->describe('->store()', function () {
            $this->describe('will return SuccessResponse', function () {

                $warehouse = (new Warehouse())
                    ->setId(1)
                    ->setName('warehouse1');

                $request = (new Request())->setResource($warehouse);

                $result = $this->controller->get($request);
                verify($result)->instanceOf(SuccessResponse::class);
            });
        });

        $this->describe('->patch()', function () {
            $this->describe('will return SuccessResponse', function () {

                $warehouse = (new Warehouse())
                    ->setId(1)
                    ->setName('warehouse1');

                $request = (new Request())->setResource($warehouse);

                $result = $this->controller->patch($request);
                verify($result)->instanceOf(SuccessResponse::class);
            });
        });

        $this->describe('->delete()', function () {
            $this->describe('will return SuccessResponse', function () {

                $warehouse = (new Warehouse())
                    ->setId(1)
                    ->setName('warehouse1');

                $request = (new Request())->setResource($warehouse);

                $result = $this->controller->delete($request);
                verify($result)->instanceOf(SuccessResponse::class);
            });
        });
    }
}
