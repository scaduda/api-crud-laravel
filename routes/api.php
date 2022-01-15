<?php

use App\Http\Controllers\PeopleController;
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

Route::middleware('auth:api')->get(
    '/user',
    function (Request $request) {
    return $request->user();
});

Route::prefix('v1/')->group(function () {
    Route::prefix('people')->group(function () {
        Route::get('', [PeopleController::class, 'index']);
        Route::post('', [PeopleController::class, 'store']);
        Route::get('{id}', [PeopleController::class, 'show']);
        Route::put('{id}', [PeopleController::class, 'update']);
        Route::delete('{id}', [PeopleController::class, 'destroy']);
    });
});
