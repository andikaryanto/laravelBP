<?php

namespace App\Routes\Product;

use App\Http\Controllers\Product\CategoryController;
use App\Http\Controllers\Product\VariantController;
use App\Http\Middleware\Hydrators\Product\CategoryHydrator;
use App\Http\Middleware\Hydrators\ProductHydrator;
use App\Http\Middleware\ResourceBelongsToPartner;
use App\Http\Middleware\SetPartnerToRequest;
use App\Http\Middleware\SetPartnerShopToResource;
use Illuminate\Support\Facades\Route;
use LaravelCommon\App\Http\Middleware\CheckScope;
use LaravelCommon\App\Http\Middleware\CheckToken;
use LaravelCommon\App\Http\Middleware\EntityUnit;
use LaravelCommon\App\Http\Middleware\ResourceValidation;
use LaravelCommon\App\Routes\CommonRoute;

class VariantRoute extends CommonRoute
{
    /**
     * register product-category route
     *
     * @return void
     */
    public static function register()
    {

        return Route::get('product/{product}/product-variants', [VariantController::class, 'getProductVariant'])
            ->middleware([
                CheckToken::NAME,
                CheckScope::NAME . ':partner',
                SetPartnerToRequest::NAME,
                ProductHydrator::NAME,
                ResourceBelongsToPartner::NAME
            ]);

        //  Route::prefix('product-variant')->group(function () {
        //     Route::middleware([CheckToken::NAME])->group(function () {
        //         Route::get('/list', [CategoryController::class, 'getAll'])
        //             ->middleware([
        //                 CheckScope::NAME . ':partner',
        //                 SetPartnerToRequest::NAME,
        //             ]);

        //         Route::post('/store', [CategoryController::class, 'store'])
        //             ->middleware(
        //                 [
        //                     CheckScope::NAME . ':partner',
        //                     SetPartnerToRequest::NAME,
        //                     CategoryHydrator::NAME,
        //                     SetPartnerShopToResource::NAME,
        //                     ResourceValidation::NAME,
        //                     EntityUnit::NAME
        //                 ]
        //             );

        //         Route::get('/{category}', [CategoryController::class, 'get'])->middleware('hydrator.product-category');
        //         Route::patch('/{category}', [CategoryController::class, 'patch'])
        //             ->middleware(
        //                 [
        //                     CategoryHydrator::NAME,
        //                     ResourceValidation::NAME,
        //                     EntityUnit::NAME
        //                 ]
        //             );
        //         Route::delete('/{category}', [CategoryController::class, 'delete'])->middleware(
        //             [
        //                 CategoryHydrator::NAME,
        //                 EntityUnit::NAME
        //             ]
        //         );
        //     });
        // });
    }
}
