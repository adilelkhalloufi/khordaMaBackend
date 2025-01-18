<?php

use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UniteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// I want to make public route for show list product and categories and unites 

Route::get('products', [ProductsController::class, "GetPublicProducts"]);
Route::get('categorie', [CategorieController::class, "GetCategories"]);
Route::get('unites', [UniteController::class, "GetUnites"]);
