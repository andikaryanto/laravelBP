<?php

namespace App\Routes;

use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use LaravelCommon\App\Routes\CommonRoute;

class UserRoute extends CommonRoute
{
    /**
     * register warehouse route
     *
     * @return void
     */
    public static function register()
    {
        return Route::prefix('user')->group(function () {
            Route::post('/register', [UserController::class, 'register']);
        });
    }
}
