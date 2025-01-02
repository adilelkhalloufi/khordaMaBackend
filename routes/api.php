<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// give me route with example parames for api
Route::get('example/{name}/{age}/{city}', function (
    $name,
    $age,
    $city
) {
    return response()->json([
        'message' => 'Hello, World!',
        'params' => [
            'name' => $name . " mongo",
            'age' => $age,
            'city' => $city
        ]
    ]);
});