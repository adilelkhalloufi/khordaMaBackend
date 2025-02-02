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
Route::resource('products', ProductController::class);
Route::get('specialities', [SpecialitieController::class, 'index']);

Route::post('login', [AuthController::class, 'login']);

Route::post('register', [AuthController::class, 'register']);
Route::post('forget-password', [AuthController::class, 'forgetPassword']);

// Protected routes
Route::group(['middleware' => ['auth:sanctum']], function (): void {

    Route::post('logout', [AuthController::class, 'logout']);

    // api to create products
    Route::resource('product', ProductController::class);
    Route::post('addToFavaris', FavarisController::class);
    Route::resource('order', OrderController::class);
    Route::resource('bid', BidController::class);
});
