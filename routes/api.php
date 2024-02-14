<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::post('/register',[AuthController::class,'registerUser']);
Route::post('/login',[AuthController::class,'loginUser']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/users',[UserController::class,'index']);
    //Route::get('/user/create',[UserController::class,'createUser']);

    //Clients
    Route::apiResource('clients', ClientController::class);
    Route::apiResource('providers', ProviderController::class);
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('products', ProductController::class);
});
