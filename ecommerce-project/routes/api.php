<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Models\Product;
use App\Events\OutOfStock;

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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Auth::routes([
    'verify' => true,
]);

Route::post('/signup', [AuthController::class, 'signUp'])->middleware('guest');

Route::middleware(['guest'])->post('/login', [AuthController::class, 'logIn']);

Route::middleware(['auth:sanctum'])->post('/logout', [AuthController::class, 'logOut']);

Route::middleware(['auth:sanctum'])->group(function() {
    Route::get('/orders', [OrderController::class, 'index']); 
    Route::post('/orders/add', [OrderController::class, 'create']);
    Route::patch('/update-order/{order}', [OrderController::class, 'update']);
    Route::get('/order/show/{order}', [OrderController::class, 'show']);

    Route::get('/profile', [UserController::class, 'show']);
    Route::patch('/profile', [UserController::class, 'update']);

    Route::get('/favorites', [WishlistController::class, 'index']);
    Route::post('/favorites/add/{product}', [WishlistController::class, 'create']);
    Route::delete('/favorites/remove/{product}', [WishlistController::class, 'destroy']);
});

Route::get('/products', [ProductController::class, 'index']);


//for testing:
Route::post('/product-out-of-stock/{product}', function(Product $product) {
    event(new OutOfStock($product));
});

