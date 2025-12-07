<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PokirController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/pokir/input-massal', [PokirController::class, 'createBulk'])->name('pokir.bulk'); 
    Route::post('/pokir/input-massal', [PokirController::class, 'storeBulk'])->name('pokir.storeBulk');
    Route::get('/pokir', [PokirController::class, 'index'])->name('pokir.index');
    Route::get('/pokir/create', [PokirController::class, 'create'])->name('pokir.create'); // Baru
    Route::post('/pokir', [PokirController::class, 'store'])->name('pokir.store');
    Route::get('/pokir/print', [PokirController::class, 'print'])->name('pokir.print');
    Route::get('/pokir/export', [PokirController::class, 'exportExcel'])->name('pokir.export');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
