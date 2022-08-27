<?php

use App\Entities\Product\Category;
use App\Http\Controllers\Product\CategoryController;
use App\Repositories\Product\CategoryRepository;
use App\ViewModels\Product\CategoryCollection;
use Codeception\Specify;
use LaravelCommon\Responses\NoDataFoundResponse;
use LaravelCommon\Responses\SuccessResponse;
use LaravelCommon\System\Http\Request;
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

            $this->controller = new CategoryController(
                $this->categoryRepository->reveal()
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
            $this->describe('will return SuccessResponse', function () {

                $category = (new Category())
                    ->setId(1)
                    ->setName('category1');

                $request = (new Request())->setResource($category);

                $result = $this->controller->get($request);
                verify($result)->instanceOf(SuccessResponse::class);
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
