<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PokirController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\AiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PlanController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::middleware('auth')->group(function () {
    // === 1. MODUL POKIR ===
    // Input Massal (Prioritas Utama)
    Route::get('/pokir/input-massal', [PokirController::class, 'createBulk'])->name('pokir.bulk');
    Route::post('/pokir/input-massal', [PokirController::class, 'storeBulk'])->name('pokir.storeBulk');

    // List Data & Fitur Pendukung
    Route::get('/pokir', [PokirController::class, 'index'])->name('pokir.index');
    Route::get('/pokir/create', [PokirController::class, 'create'])->name('pokir.create'); // Input Satuan (Opsional)
    Route::post('/pokir', [PokirController::class, 'store'])->name('pokir.store');
    Route::get('/pokir/export', [PokirController::class, 'exportExcel'])->name('pokir.export');
    Route::get('/pokir/print', [PokirController::class, 'print'])->name('pokir.print');

    // === 2. MODUL MASTER DATA ===
    Route::get('/master', [MasterController::class, 'index'])->name('master.index');

    // Action Master Data
    Route::post('/master/aleg', [MasterController::class, 'storeAleg'])->name('master.aleg.store');
    Route::delete('/master/aleg/{aleg}', [MasterController::class, 'destroyAleg'])->name('master.aleg.destroy');

    Route::post('/master/opd', [MasterController::class, 'storeOpd'])->name('master.opd.store');
    Route::delete('/master/opd/{opd}', [MasterController::class, 'destroyOpd'])->name('master.opd.destroy');

    Route::post('/master/kategori', [MasterController::class, 'storeKategori'])->name('master.kategori.store');
    Route::delete('/master/kategori/{kategori}', [MasterController::class, 'destroyKategori'])->name('master.kategori.destroy');

  // Route Master Plan (Wadah)
  Route::get('/master/plans', [PlanController::class, 'index'])->name('plans.index');
  Route::post('/master/plans/import', [PlanController::class, 'import'])->name('plans.import');

    

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
