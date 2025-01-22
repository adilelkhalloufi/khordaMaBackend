<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\FavarisController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UniteController;
 use Illuminate\Support\Facades\Route;
 

//  Public routes
Route::get('categorie', [CategorieController::class, 'index']);
Route::get('unites', [UniteController::class, 'index']);
Route::get('products', [ProductController::class, 'index']);


Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

// Protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('addToFavaris', FavarisController::class);
});


