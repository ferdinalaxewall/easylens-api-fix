<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\TransactionsController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::resource('products', ProductsController::class);
Route::prefix("products")->group(function (){
    Route::get("/", [ProductsController::class, 'index']);
    Route::post("/", [ProductsController::class, 'store']);
    Route::get("/{id}", [ProductsController::class, 'show']);
    Route::post("/{id}", [ProductsController::class, 'update']);
    Route::delete("/{id}", [ProductsController::class, 'destroy']);
});

Route::prefix("users")->group(function (){
    Route::get("/", [AccountsController::class, 'index']);
    Route::post("/", [AccountsController::class, 'store']);
    Route::get("/{id}", [AccountsController::class, 'show']);
    Route::post("/{id}", [AccountsController::class, 'update']);
    Route::delete("/{id}", [AccountsController::class, 'destroy']);
});

Route::prefix("transactions")->group(function (){
    Route::get("/", [TransactionsController::class, 'index']);
    Route::post("/", [TransactionsController::class, 'store']);
    Route::get("/{id}", [TransactionsController::class, 'show']);
    Route::post("/{id}", [TransactionsController::class, 'update']);
    Route::delete("/{id}", [TransactionsController::class, 'destroy']);
});
