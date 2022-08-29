<?php

namespace App\Routes;

use App\Http\Controllers\WarehouseController;
use Illuminate\Support\Facades\Route;
use LaravelCommon\App\Routes\CommonRoute;

class WarehouseRoute extends CommonRoute
{
    /**
     * register shop route
     *
     * @return void
     */
    public static function register()
    {
        return Route::prefix('warehouse')->group(function () {
            Route::middleware(['check-token','check-scope:marketOrganizer'])->group(function () {
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
    }
}
