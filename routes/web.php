<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TradeRecordsController;
use App\Http\Controllers\TradePerformanceController;
use App\Http\Controllers\UserPersonController;
use App\Http\Controllers\TradeSettingsController;
use App\Http\Controllers\MarketInformationController;
use App\Http\Controllers\CapitalAndRiskMgmtController;
use App\Http\Controllers\TradingStrategyController;
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

    Route::get('/trade-settings', [TradeSettingsController::class, 'edit'])->name('trade-settings.edit');
    Route::patch('/market-information', [MarketInformationController::class, 'update'])->name('market-information.update');
    Route::post('/capital-and-risk', [CapitalAndRiskMgmtController::class, 'store'])->name('capital-and-risk.store');
    Route::patch('/capital-and-risk', [CapitalAndRiskMgmtController::class, 'update'])->name('capital-and-risk.update');
    Route::post('/trading-strategy', [TradingStrategyController::class, 'store'])->name('trading-strategy.store');
    Route::patch('/trading-strategy', [TradingStrategyController::class, 'update'])->name('trading-strategy.update');


    Route::get('/admin/users', [UserPersonController::class, 'show'])->name('users.show');
    Route::patch('/admin/users', [UserPersonController::class, 'update'])->name('users.update');

});

require __DIR__.'/auth.php';
