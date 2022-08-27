<?php

use App\Http\Controllers\Product\CategoryController;
use App\Http\Controllers\JustTest;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\User\ShopMappingController;
use App\Http\Controllers\WarehouseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/justtest', [JustTest::class, 'test']);

Route::prefix('warehouse')->group(function () {
    Route::middleware(['check-token'])->group(function () {
        Route::get('/list', [WarehouseController::class, 'getAll']);

        Route::post('/store', [WarehouseController::class, 'store'])
            ->middleware(
                [
                    'hydrator.warehouse',
                    'resource-validation',
                    'entity-unit'
                ]
            );

        Route::get('/{id}', [WarehouseController::class, 'get'])->middleware('hydrator.warehouse');
        Route::patch('/{id}', [WarehouseController::class, 'patch'])
            ->middleware(
                [
                    'hydrator.warehouse',
                    'resource-validation',
                    'entity-unit'
                ]
            );
        Route::delete('/{id}', [WarehouseController::class, 'delete'])->middleware(
            [
                'hydrator.warehouse',
                'entity-unit'
            ]
        );
    });
});

Route::prefix('shop')->group(function () {
    Route::middleware(['check-token'])->group(function () {
        Route::get('/list', [ShopController::class, 'getAll']);

        Route::post('/store', [ShopController::class, 'store'])
            ->middleware(
                [
                    'hydrator.shop',
                    'resource-validation',
                    'entity-unit'
                ]
            );

        Route::get('/{id}', [ShopController::class, 'get'])->middleware('hydrator.shop');
        Route::patch('/{id}', [ShopController::class, 'patch'])
            ->middleware(
                [
                    'hydrator.shop',
                    'resource-validation',
                    'entity-unit'
                ]
            );
        Route::delete('/{id}', [ShopController::class, 'delete'])->middleware(
            [
                'hydrator.shop',
                'entity-unit'
            ]
        );
    });
});

Route::prefix('product-category')->group(function () {
    Route::middleware(['check-token'])->group(function () {
        Route::get('/list', [CategoryController::class, 'getAll']);

        Route::post('/store', [CategoryController::class, 'store'])
            ->middleware(
                [
                    'hydrator.product-category',
                    'resource-validation',
                    'entity-unit'
                ]
            );

        Route::get('/{id}', [CategoryController::class, 'get'])->middleware('hydrator.product-category');
        Route::patch('/{id}', [CategoryController::class, 'patch'])
            ->middleware(
                [
                    'hydrator.product-category',
                    'resource-validation',
                    'entity-unit'
                ]
            );
        Route::delete('/{id}', [CategoryController::class, 'delete'])->middleware(
            [
                'hydrator.product-category',
                'entity-unit'
            ]
        );
    });
});

Route::prefix('user-shop')->group(function () {
    Route::middleware([])->group(function () {
        Route::post('/register', [ShopMappingController::class, 'register']);
        Route::delete('/{id}', [ShopMappingController::class, 'delete'])
            ->middleware([
                'common.hydrator.user'
            ]);
        Route::get('/{id}', [ShopMappingController::class, 'get'])
            ->middleware([
                'common.hydrator.user'
            ]);
    });
});
