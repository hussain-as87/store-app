<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\UserController;
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
Route::post("login", [UserController::class, 'index']);
Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::apiResource('category', CategoryController::class)->names([
        'index' => 'api.category.index',
        'store' => 'api.category.store',
    ])->except('show', 'update', 'destroy');
    Route::get('category/show', [CategoryController::class, 'show'])->name('api.category.show');
    Route::put('category/update', [CategoryController::class, 'update'])->name('api.category.update');
    Route::delete('category/destroy', [CategoryController::class, 'destroy'])->name('api.category.destroy');

    Route::apiResource('product', ProductController::class)->names([
        'index' => 'api.product.index',
        'store' => 'api.product.store',
    ])->except('show', 'update', 'destroy');
    Route::get('product/show', [ProductController::class, 'show'])->name('api.product.show');
    Route::put('product/update', [ProductController::class, 'update'])->name('api.product.update');
    Route::delete('product/destroy', [ProductController::class, 'destroy'])->name('api.product.destroy');

});
