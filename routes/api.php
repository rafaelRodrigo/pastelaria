<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;


////// ************* Cliente **************** ///////////////

Route::get("client", [ClientController::class,"getAll"]);
Route::get("client/{id}", [ClientController::class,"get"]);
Route::post("client", [ClientController::class,"post"]);
Route::put("client/{id}", [ClientController::class,"put"]);
Route::delete("client/{id}", [ClientController::class,"delete"]);

////// ************* Cliente **************** ///////////////
