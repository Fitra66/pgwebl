<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/points', [ApiController::class, 'points'])->name('_geojson_points');
Route::get('/polylines', [ApiController::class, 'polylines'])->name('_geojson_polylines');
Route::get('/polygons', [ApiController::class, 'polygons'])->name('_geojson_polygons');
