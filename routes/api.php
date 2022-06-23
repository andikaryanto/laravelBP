<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\JustTest;
use App\Http\Controllers\MemberController;
use Illuminate\Http\Request;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {

    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout',  [AuthController::class, 'logout']);
    Route::post('/refresh',  [AuthController::class, 'refresh']);
    Route::post('/me', [AuthController::class, 'me']);
});

Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'member'
], function ($router) {

    Route::post('/store', [MemberController::class, 'store']);
    Route::get('/list', [MemberController::class, 'getAll']);
    Route::put('/update/{id}',  [MemberController::class, 'update']);
});

// Route::get('/justtest', [JustTest::class, 'test']);
