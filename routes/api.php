<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\AuthController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/logout', [AuthController::class, 'logout']);
});


// Route::get('/products', [ProductsController::class, 'index']);
// Route::post('/products', [ProductsController::class, 'store']);
// Route::get('/products/{id}', [ProductsController::class, 'show']);
// Route::put('/products/{id}', [ProductsController::class, 'update']);
// Route::delete('/products/{id}', [ProductsController::class, 'destroy']);

Route::resource('/products', ProductsController::class)->except(['create','edit']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);