<?php

namespace App\Routes;

use App\Http\Controllers\ProductCategoryController;
use App\Http\Middleware\Hydrators\ProductCategoryHydrator;
use App\Http\Middleware\SetPartnerToRequest;
use App\Http\Middleware\SetPartnerShopToResource;
use Illuminate\Support\Facades\Route;
use LaravelCommon\App\Http\Middleware\CheckScope;
use LaravelCommon\App\Http\Middleware\CheckToken;
use LaravelCommon\App\Http\Middleware\EntityUnit;
use LaravelCommon\App\Http\Middleware\ResourceValidation;
use LaravelCommon\App\Routes\CommonRoute;

class ProductCategoryRoute extends CommonRoute
{
    /**
     * register product-category route
     *
     * @return void
     */
    public static function register()
    {
        return Route::prefix('product-category')->group(function () {
            Route::middleware([CheckToken::NAME])->group(function () {
                Route::get('/list', [ProductCategoryController::class, 'getAll'])
                    ->middleware([
                        CheckScope::NAME . ':partner',
                        SetPartnerToRequest::NAME,
                    ]);

                Route::post('/store', [ProductCategoryController::class, 'store'])
                    ->middleware(
                        [
                            CheckScope::NAME . ':partner',
                            SetPartnerToRequest::NAME,
                            ProductCategoryHydrator::NAME,
                            SetPartnerShopToResource::NAME,
                            ResourceValidation::NAME,
                            EntityUnit::NAME
                        ]
                    );

                Route::get('/{category}', [ProductCategoryController::class, 'get'])->middleware('hydrator.product-category');
                Route::patch('/{category}', [ProductCategoryController::class, 'patch'])
                    ->middleware(
                        [
                            ProductCategoryHydrator::NAME,
                            ResourceValidation::NAME,
                            EntityUnit::NAME
                        ]
                    );
                Route::delete('/{category}', [ProductCategoryController::class, 'delete'])->middleware(
                    [
                        ProductCategoryHydrator::NAME,
                        EntityUnit::NAME
                    ]
                );
            });
        });
    }
}
