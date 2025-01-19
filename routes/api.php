<?php

use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UniteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');




Route::get('categorie', [CategorieController::class, "index"]);
Route::get('unites', [UniteController::class, "index"]);
Route::get('products', [ProductController::class, "index"]);
