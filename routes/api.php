<?php

use App\Repositories\PartnerRepository;
use App\Routes\PartnerRoute;
use App\Routes\Product\CategoryRoute;
use App\Routes\ProductRoute;
use App\Routes\ShopRoute;
use App\Routes\WarehouseRoute;
use GrahamCampbell\ResultType\Success;
use Illuminate\Support\Facades\Route;
use LaravelCommon\Responses\SuccessResponse;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/test', function(){
    return new SuccessResponse('OKE', [], 'oke');
});

WarehouseRoute::register();
ShopRoute::register();
CategoryRoute::register();
PartnerRoute::register();
ProductRoute::register();
