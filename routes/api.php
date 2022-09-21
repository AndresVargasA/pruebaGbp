<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\WineryController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HistoryController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group([
    'prefix' => 'user'
], function (){
    Route::get('/', [UserController::class, 'index']);
    Route::get('/{id}', [UserController::class, 'show']);
    Route::post('/', [UserController::class, 'store']);
    Route::put('/{id}', [UserController::class, 'update']);
    Route::delete('/{id}', [UserController::class, 'destroy']);
});


Route::group([
    'prefix' => 'product'
], function (){
    Route::get('/', [ProductController::class, 'index']);
    Route::get('/{id}', [ProductController::class, 'show']);
    Route::post('/', [ProductController::class, 'store']);
    Route::put('/{id}', [ProductController::class, 'update']);
    Route::delete('/{id}', [ProductController::class, 'destroy']);
});
Route::group([
    'prefix' => 'winery'
], function (){
    Route::get('/', [WineryController::class, 'index']);
    Route::get('/{id}', [WineryController::class, 'show']);
    Route::post('/', [WineryController::class, 'store']);
    Route::put('/{id}', [WinteryController::class, 'update']);
    Route::delete('/{id}', [WineryController::class, 'destroy']);
});


Route::group([
    'prefix' => 'inventory'
], function (){
    Route::get('/', [InventoryController::class, 'index']);
    Route::get('/{id}', [InventoryController::class, 'show']);
    Route::post('/', [InventoryController::class, 'store']);
    Route::put('/{id}', [InventoryController::class, 'update']);
    Route::delete('/{id}', [InventoryController::class, 'destroy']);
});

Route::group([
    'prefix' => 'history'
], function (){
    Route::get('/', [HistoryController::class, 'index']);
    Route::get('/{id}', [HistoryController::class, 'show']);
    Route::post('/', [HistoryController::class, 'store']);
    Route::put('/{id}', [HistoryController::class, 'update']);
    Route::delete('/{id}', [HistoryController::class, 'destroy']);
});
