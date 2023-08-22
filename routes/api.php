<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::get('categories',[CategoryController::class, 'index']);
// Route::post('categories/store',[CategoryController::class, 'store']);


// Route::post('register',[AuthController::class, 'register']);
// Route::post('login',[AuthController::class, 'login']);
// Route::middleware('auth:sanctum')->group(function(){
//     Route::get('user',[AuthController::class, 'user']);
//     Route::delete('logout',[AuthController::class, 'logout']);
// });

// Route::apiResource('categories',CategoryController::class);
// Route::apiResource('posts',PostController::class);

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', [AuthController::class, 'user']);
    Route::delete('logout', [AuthController::class, 'logout']);

    Route::apiResource('categories', CategoryController::class);

    Route::apiResource('posts', PostController::class);
});