<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TradeRecordsController;
use App\Http\Controllers\TradePerformanceController;
use App\Http\Controllers\UserPersonController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/trade-records/entries', [TradeRecordsController::class, 'show'])->name('trade-records.show');
    Route::post('/trade-records/entries', [TradeRecordsController::class, 'store'])->name('trade-records.store');
    Route::patch('/trade-records/entries', [TradeRecordsController::class, 'update'])->name('trade-records.update');
    Route::get('/trade-records/performance', [TradePerformanceController::class, 'show'])->name('trade-performance.show');


    Route::get('/admin/users', [UserPersonController::class, 'show'])->name('users.show');
    Route::patch('/admin/users', [UserPersonController::class, 'update'])->name('users.update');

});

require __DIR__.'/auth.php';
