<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BidController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\FavarisController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SpecialitieController;
use App\Http\Controllers\UniteController;
use Illuminate\Support\Facades\Route;

//  Public routes
Route::get('categorie', [CategorieController::class, 'index']);
Route::get('unites', [UniteController::class, 'index']);
Route::get('products', [ProductController::class, 'GetProduct']);
Route::get('specialities', [SpecialitieController::class, 'index']);

Route::post('login', [AuthController::class, 'login']);

Route::post('register', [AuthController::class, 'register']);
Route::post('forget-password', [AuthController::class, 'forgetPassword']);

// Protected routes
Route::group(['middleware' => ['auth:sanctum']], function (): void {

    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('orders', [OrderController::class, 'store']);
   
    Route::get('GetOrderForSeller', [OrderController::class, 'GetOrderForSeller']);
    Route::resource('product', ProductController::class);
    Route::resource('favoris', FavarisController::class);
    Route::resource('order', OrderController::class);
    Route::resource('bid', BidController::class);
});
