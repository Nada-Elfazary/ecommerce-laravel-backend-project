<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\ProductController;

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

Route::post('/signup', [AuthController::class, 'signUp']);

Route::post('/login', [AuthController::class, 'logIn']);

Route::middleware(['auth:sanctum'])->post('/logout', [AuthController::class, 'logOut']);

Route::middleware(['auth:sanctum'])->group(function() {
    Route::get('/orders', [OrderController::class, 'index'])->middleware('verified');

    Route::get('/profile', [UserController::class, 'show']);
    Route::patch('/profile', [UserController::class, 'update']);

    Route::get('/favorites', [WishlistController::class, 'index']);
    Route::post('/add-favorite/{product}', [WishlistController::class, 'create']);
    Route::delete('/remove-favorite/{product}', [WishlistController::class, 'destroy']);
});

Route::get('/products', [ProductController::class, 'index']);
