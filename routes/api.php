<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\ClothesController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get( "/users", [ AuthController::class, "getUsers" ]);
Route::put( "/admin", [ AuthController::class, "setAdmin" ]);
Route::put( "updateuser", [ AuthController::class, "updateUser" ]);
Route::delete( "/deleteuser", [ AuthController::class, "destroyUser" ]);

Route::post( "/register", [ UserController::class, "register" ]);
Route::post( "/login", [ UserController::class, "login" ]);
Route::get( "/logout", [ UserController::class, "logout" ]);
Route::get( "/tokens", [ UserController::class, "getTokens" ]);

Route::get( "/clothes", [ClothesController::class, "clothes"]);
Route::get( "/brand", [ClothesController::class, "brand"]);
Route::get( "/material", [ClothesController::class, "material"]);
Route::get( "/type", [ClothesController::class, "type"]);