<?php

namespace App\Routes;

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use LaravelCommon\App\Routes\CommonRoute;

class ProductRoute extends CommonRoute
{
    /**
     * register shop route
     *
     * @return void
     */
    public static function register()
    {
        return Route::prefix('product')->group(function () {
            Route::get('/list', [ProductController::class, 'getAll']);
            Route::middleware(['check-token'])->group(function () {
                Route::post('/store', [ProductController::class, 'store'])
                    ->middleware(
                        [
                            'check-scope:partner',
                            'set-partner-to-request',
                            'hydrator.product',
                            'set-shop-to-resource'
                        ]
                    );
                // Route::get('/{id}', [ProductController::class, 'get'])->middleware('hydrator.product');
                // Route::patch('/{id}', [ProductController::class, 'patch'])
                //     ->middleware(
                //         [
                //             'hydrator.product',
                //             'resource-validation',
                //             'entity-unit'
                //         ]
                //     );
                // Route::delete('/{id}', [ProductController::class, 'delete'])->middleware(
                //     [
                //         'hydrator.product',
                //         'entity-unit'
                //     ]
                // );
            });
        });
    }
}
