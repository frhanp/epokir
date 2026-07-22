<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PokirController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\AiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ResesController;

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
    Route::post('/pokir/import', [PokirController::class, 'importExcel'])->name('pokir.import');

    // List Data & Fitur Pendukung
    Route::get('/pokir', [PokirController::class, 'index'])->name('pokir.index');
    Route::get('/pokir/create', [PokirController::class, 'create'])->name('pokir.create'); // Input Satuan (Opsional)
    Route::post('/pokir', [PokirController::class, 'store'])->name('pokir.store');
    Route::get('/pokir/export', [PokirController::class, 'exportExcel'])->name('pokir.export');
    Route::get('/pokir/print', [PokirController::class, 'print'])->name('pokir.print');

    // === 2. MODUL MASTER DATA ===

    // Route Master Plan (Wadah)
    Route::get('/master/plans', [PlanController::class, 'index'])->name('plans.index');
    Route::post('/master/plans/import', [PlanController::class, 'import'])->name('plans.import');

    Route::put('/master/plans/{plan}', [PlanController::class, 'update'])->name('plans.update');
    Route::post('/master/plans/store', [PlanController::class, 'store'])->name('plans.store');
    Route::delete('/master/plans/aleg', [PlanController::class, 'destroyByAleg'])->name('plans.destroyAleg');
    Route::delete('/master/plans/{plan}', [PlanController::class, 'destroy'])->name('plans.destroy');

    Route::get('/reses/lampiran', [ResesController::class, 'index'])->name('reses.index');
    Route::post('/reses/cetak', [ResesController::class, 'printPdf'])->name('reses.print');


    Route::get('/api/cek-pagu', [DashboardController::class, 'cekPagu'])->name('api.cek_pagu');




    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
