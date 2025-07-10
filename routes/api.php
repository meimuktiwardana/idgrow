<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ProdukController;
use App\Http\Controllers\Api\LokasiController;
use App\Http\Controllers\Api\MutasiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Authentication routes
Route::post('/login', [AuthController::class, 'login']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    
    // User routes
    Route::apiResource('users', UserController::class);
    Route::get('users/{id}/mutasi-history', [UserController::class, 'mutasiHistory']);
    
    // Produk routes
    Route::apiResource('produks', ProdukController::class);
    Route::get('produks/{id}/mutasi-history', [ProdukController::class, 'mutasiHistory']);
    
    // Lokasi routes
    Route::apiResource('lokasis', LokasiController::class);
    
    // Mutasi routes
    Route::apiResource('mutasis', MutasiController::class);
});