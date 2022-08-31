<?php

namespace App\Routes\Product;

use App\Http\Controllers\Product\CategoryController;
use Illuminate\Support\Facades\Route;
use LaravelCommon\App\Routes\CommonRoute;

class CategoryRoute extends CommonRoute
{
    /**
     * register product-category route
     *
     * @return void
     */
    public static function register()
    {
        return Route::prefix('product-category')->group(function () {
            Route::middleware(['check-token'])->group(function () {
                Route::get('/list', [CategoryController::class, 'getAll']);

                Route::post('/store', [CategoryController::class, 'store'])
                    ->middleware(
                        [
                            'check-scope:partner',
                            'set-partner-to-user',
                            'hydrator.product-category'
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
    }
}
