<?php

use App\Routes\Product\CategoryRoute;
use App\Routes\ShopRoute;
use App\Routes\User\ShopMappingRoute;
use App\Routes\WarehouseRoute;

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

WarehouseRoute::register();
ShopRoute::register();
CategoryRoute::register();
ShopMappingRoute::register();
