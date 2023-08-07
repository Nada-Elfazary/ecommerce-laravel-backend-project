<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

Route::middleware(['auth:sanctum'])->group(function() {
    Route::get('/orders', [OrderController::class, 'index']);

    Route::get('/profile', [UserController::class, 'show']);
    Route::post('/profile', [UserController::class, 'edit']);
});

Route::get('/products', [ProductController::class, 'index']);



require __DIR__.'/auth.php';
