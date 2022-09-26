<?php

use App\Queries\ProductCategoryQuery;
use App\Repositories\ProductCategoryRepository;
use App\Routes\PartnerRoute;
use App\Routes\ProductCategoryRoute;
use App\Routes\Product\VariantRoute;
use App\Routes\ProductRoute;
use App\Routes\ShopRoute;
use App\Routes\WarehouseRoute;
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

Route::get('/test', function(ProductCategoryQuery $categoryQuery, ProductCategoryRepository $categoryRepository){
    $categories = $categoryQuery->where('shop_id', '=', 1)->getIterator();
    // $data = $categoryRepository->collect();
    foreach($categories as $c){
        echo $c->getId();
    }
    return new SuccessResponse('OKE', [], 'oke');
});

WarehouseRoute::register();
ShopRoute::register();
ProductCategoryRoute::register();
PartnerRoute::register();
ProductRoute::register();
// VariantRoute::register();
