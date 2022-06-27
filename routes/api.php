<?php

use App\Http\Controllers\JustTest;
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
Route::post('/test', function(RequestRequest $request){
    $a = $request->name;
    return 'asdasd';
});