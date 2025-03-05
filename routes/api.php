<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\ClothesController;
use App\Http\Controllers\api\TypeController;
use App\Http\Controllers\api\BrandController;
use App\Http\Controllers\api\MaterialController;


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

Route::get( "/clothes", [ClothesController::class, "getClothes"]);
Route::get( "/brand", [ClothesController::class, "brand"]);
Route::get( "/material", [ClothesController::class, "material"]);
Route::get( "/type", [ClothesController::class, "type"]);
Route::post( "/newcloth", [ClothesController::class, "newCloth"]);

Route::post( "/newtype", [TypeController::class, "newType"]);

Route::post( "/newbrand", [BrandController::class, "newBrand"]);

Route::post( "/newmaterial", [MaterialController::class, "newMaterial"]);