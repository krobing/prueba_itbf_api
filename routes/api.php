<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HotelController;
use App\Http\Controllers\HabitacionController;
// use App\Http\Controllers\TipoAcomodacionController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('hoteles', HotelController::class)->only(['index', 'store', 'show']);
Route::apiResource('habitaciones', HabitacionController::class)->only(['index', 'store', 'show']);
// Route::apiResource('tipo-acomodaciones', TipoAcomodacionController::class);
