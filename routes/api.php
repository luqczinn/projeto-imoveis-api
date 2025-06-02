<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\OwnerController;
use App\Http\Controllers\Api\PropertyController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('owners', OwnerController::class);

// Rotas de imóveis
Route::apiResource('properties', PropertyController::class);

// Filtro de imóveis (busca por cidade, valor mínimo e máximo)
Route::get('properties/search/filter', [PropertyController::class, 'search']);