<?php

use App\Repositories\PartnerRepository;
use App\Routes\Product\CategoryRoute;
use App\Routes\ShopRoute;
use App\Routes\WarehouseRoute;
use Illuminate\Support\Facades\Route;

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
    $repo = new PartnerRepository();
    $partners = $repo->collect();
    foreach($partners as $partner){
        echo $partner->getUser()->getId();
    }
});

WarehouseRoute::register();
ShopRoute::register();
CategoryRoute::register();
