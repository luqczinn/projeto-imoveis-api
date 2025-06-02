<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\OwnerController;
use App\Http\Controllers\Api\PropertyController;
use App\Http\Controllers\AuthController;


Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class,'register']);

    Route::post('login', [AuthController::class,'login']);

    Route::post('logout', [AuthController::class,'logout']);
});

Route::apiResource('owners', OwnerController::class)->middleware('auth:sanctum');

Route::apiResource('properties', PropertyController::class)->middleware('auth:sanctum');

Route::get('properties/search/filter', [PropertyController::class, 'search'])->middleware('auth:sanctum');

