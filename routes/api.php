<?php

use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\FavoriteProductControoler;
use App\Http\Controllers\Api\OrderProductController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\RatingProductControoler;
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
Route::post('/login', [UserController::class, 'login']);
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

 Route::apiResource('users', UserController::class)->names([
        'index' => 'api.users.index',
        'store' => 'api.users.store',
    ])->except('show', 'update', 'destroy');
    Route::get('users/show', [UserController::class, 'show'])->name('api.users.show');
    Route::put('users/update', [UserController::class, 'update'])->name('api.users.update');
    Route::delete('users/destroy', [UserController::class, 'destroy'])->name('api.users.destroy');
    Route::put('users/profile', [UserController::class, 'editProfile'])->name('api.users.profile');


    Route::post('favorite_product',[FavoriteProductControoler::class, 'store'])->name('api.favorite.store');
    Route::delete('favorite_product',[FavoriteProductControoler::class, 'destroy'])->name('api.favorite.destroy');

    Route::post('rating_product',[RatingProductControoler::class, 'store'])->name('api.rating.store');
    Route::delete('rating_product',[RatingProductControoler::class, 'destroy'])->name('api.rating.destroy');

    Route::get('cart',[CartController::class, 'index'])->name('api.cart.index');
    Route::post('cart',[CartController::class, 'store'])->name('api.cart.store');
    Route::delete('cart',[CartController::class, 'destroy'])->name('api.cart.destroy');

    Route::get('order_products',[OrderProductController::class, 'index'])->name('api.order_products.index');
    Route::post('order_products',[OrderProductController::class, 'store'])->name('api.order_products.store');
    Route::delete('order_products',[OrderProductController::class, 'destroy'])->name('api.order_products.destroy');
});
