<?php

namespace App\Routes;

use App\Http\Controllers\PartnerController;
use Illuminate\Support\Facades\Route;
use LaravelCommon\App\Routes\CommonRoute;

class PartnerRoute extends CommonRoute
{
    /**
     * register warehouse route
     *
     * @return void
     */
    public static function register()
    {
        return Route::prefix('partner')->group(function () {
            Route::post('/register', [PartnerController::class, 'register']);
        });
    }
}
