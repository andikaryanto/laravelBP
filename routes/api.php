<?php

use App\Http\Controllers\JustTest;
use App\Http\Controllers\WarehouseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use LaravelCommon\Http\Request\Request as RequestRequest;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/justtest', [JustTest::class, 'test']);

Route::prefix('warehouse')->group(function () {
    Route::middleware(['check-token', 'check-scope:warehouser'])->group(function () {
        Route::get('/list', [WarehouseController::class, 'getAll']);

        Route::post('/store', [WarehouseController::class, 'store'])
            ->middleware(
                [
                    'hydrator.warehouse', 
                    'resource-validation', 
                    'entity-unit'
                ]
            );

        Route::get('/{id}', [WarehouseController::class, 'get'])->middleware('hydrator.warehouse');
        Route::patch('/{id}', [WarehouseController::class, 'patch'])
        ->middleware(
            [
                'hydrator.warehouse', 
                'resource-validation', 
                'entity-unit'
            ]
        );
        Route::delete('/{id}', [WarehouseController::class, 'delete'])->middleware(['hydrator.warehouse', 'entity-unit']);
    });
}); 