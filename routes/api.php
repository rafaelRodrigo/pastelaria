<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;


////// ************* Cliente **************** ///////////////
Route::get("client", [ClientController::class,"getAll"]);
Route::get("client/{id}", [ClientController::class,"get"]);
Route::post("client", [ClientController::class,"post"]);
Route::put("client/{id}", [ClientController::class,"put"]);
Route::delete("client/{id}", [ClientController::class,"delete"]);
////// ************* Cliente **************** ///////////////

////// ************* Produto **************** ///////////////
Route::get("product", [ProductController::class,"getAll"]);
Route::get("product/{id}", [ProductController::class,"get"]);
Route::post("product", [ProductController::class,"post"]);
Route::put("product/{id}", [ProductController::class,"put"]);
Route::delete("product/{id}", [ProductController::class,"delete"]);
////// ************* Produto **************** ///////////////

/// ////// ************* Pedido **************** ///////////////
Route::get("order", [OrderController::class,"getAll"]);
Route::get("order/{id}", [OrderController::class,"get"]);
Route::post("order", [OrderController::class,"post"]);
Route::put("order/{id}", [OrderController::class,"put"]);
Route::delete("order/{id}", [OrderController::class,"delete"]);
//////// ************* Pedido **************** ///////////////
