<?php

namespace App\Routes;

use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;
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
                            'check-scope:marketOrganizer,customer'
                        ]
                    );;

                Route::post('/store', [ShopController::class, 'store'])
                    ->middleware(
                        [
                            'check-scope:marketOrganizer,partner',
                            'hydrator.shop'
                        ]
                    );

                Route::get('/{id}', [ShopController::class, 'get'])->middleware('hydrator.shop');
                Route::patch('/{id}', [ShopController::class, 'patch'])
                    ->middleware(
                        [
                            'check-scope:partner',
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
    }
}
