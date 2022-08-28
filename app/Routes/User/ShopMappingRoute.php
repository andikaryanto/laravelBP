<?php

namespace App\Routes\User;

use App\Http\Controllers\User\ShopMappingController;
use Illuminate\Support\Facades\Route;
use LaravelCommon\App\Routes\CommonRoute;

class ShopMappingRoute extends CommonRoute
{
    /**
     * register warehouse route
     *
     * @return void
     */
    public static function register()
    {
        return Route::prefix('user-shop')->group(function () {
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
    }
}