<?php

namespace App\Routes;

use App\Http\Controllers\ShopController;
use App\Http\Middleware\Hydrators\ShopHydrator;
use App\Http\Middleware\SetPartnerToRequest;
use Illuminate\Support\Facades\Route;
use LaravelCommon\App\Http\Middleware\CheckScope;
use LaravelCommon\App\Http\Middleware\EntityUnit;
use LaravelCommon\App\Http\Middleware\ResourceValidation;
use LaravelCommon\App\Routes\CommonRoute;

class ShopRoute extends CommonRoute
{
    /**
     * register warehouse route
     *
     * @return void
     */
    public static function register()
    {
        return Route::prefix('shop')->group(function () {
            Route::middleware(['check-token'])->group(function () {
                Route::get('/list', [ShopController::class, 'getAll'])
                    ->middleware(
                        [
                            CheckScope::NAME . ':marketOrganizer,partner',
                        ]
                    );

                Route::post('/store', [ShopController::class, 'store'])
                    ->middleware(
                        [
                            CheckScope::NAME . ':marketOrganizer,partner',
                            SetPartnerToRequest::NAME,
                            ShopHydrator::NAME,
                        ]
                    );

                Route::get('/{shop}', [ShopController::class, 'get'])->middleware('hydrator.shop');
                Route::patch('/{shop}', [ShopController::class, 'patch'])
                    ->middleware(
                        [
                            CheckScope::NAME . ':marketOrganizer,partner',
                            ShopHydrator::NAME,
                            ResourceValidation::NAME,
                            EntityUnit::NAME
                        ]
                    );
                Route::delete('/{shop}', [ShopController::class, 'delete'])->middleware(
                    [
                        ShopHydrator::NAME,
                        EntityUnit::NAME
                    ]
                );
            });
        });
    }
}
