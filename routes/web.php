<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/dashboard');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'create'])->name('login');
    Route::post('/login', [AuthController::class, 'store'])->name('login.store');
});

Route::post('/logout', [AuthController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/ip-services', [ApplicationController::class, 'ipServices'])->name('applications.ip-services');
    Route::get('/ip-services/prior-art-search', [ApplicationController::class, 'ipPriorArtSearch'])->name('applications.ip-prior-art-search');
    Route::post('/ip-services/prior-art-search', [ApplicationController::class, 'storeIpPriorArtSearch'])->name('applications.ip-prior-art-search.store');
    Route::get('/ip-services/claims-drafting', [ApplicationController::class, 'ipClaimsDrafting'])->name('applications.ip-claims-drafting');
    Route::post('/ip-services/claims-drafting', [ApplicationController::class, 'storeIpClaimsDrafting'])->name('applications.ip-claims-drafting.store');
    Route::get('/ip-services/consultation', [ApplicationController::class, 'ipConsultation'])->name('applications.ip-consultation');
    Route::post('/ip-services/consultation', [ApplicationController::class, 'storeIpConsultation'])->name('applications.ip-consultation.store');
    Route::get('/applications/{application}/download', [ApplicationController::class, 'download'])->name('applications.download');
    Route::resource('applications', ApplicationController::class)->except(['destroy']);
});
