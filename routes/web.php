<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TableController;
use App\Http\Controllers\PointsController;
use App\Http\Controllers\PolygonsController;
use App\Http\Controllers\PolylinesController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\AnalitikPasarController;

Route::get('/map', [PointsController::class, 'index']) ->name('map');

Route::get('/table', [TableController::class, 'index']) ->name('table');

Route::resource('points', PointsController::class);

Route::resource('polylines', PolylinesController::class);

Route::resource('polygons', PolygonsController::class);

Route::get('/', [PublicController::class, 'index']) ->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/analitik', [AnalitikPasarController::class, 'index'])->name('analitik');

Route::post('/vote-kategori', [AnalitikPasarController::class, 'voteKategori'])->name('vote.kategori');
Route::get('/rekap-per-pasar', [AnalitikPasarController::class, 'getRekapPerPasar'])->name('rekap.perpasar');
Route::post('/reset-vote', [AnalitikPasarController::class, 'resetVote'])->name('vote.reset');


require __DIR__.'/auth.php';
