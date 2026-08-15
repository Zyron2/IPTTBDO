<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BizDevController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DropboxController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\TechTransferController;
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
    Route::get('/ip-services/apply-ip-protection', [ApplicationController::class, 'ipApplyProtection'])->name('applications.ip-apply-protection');
    Route::post('/ip-services/apply-ip-protection', [ApplicationController::class, 'storeIpApplyProtection'])->name('applications.ip-apply-protection.store');
    Route::get('/ip-services/incentives', [ApplicationController::class, 'ipIncentives'])->name('applications.ip-incentives');
    Route::post('/ip-services/incentives', [ApplicationController::class, 'storeIpIncentives'])->name('applications.ip-incentives.store');
    Route::get('/ip-services/consultation', [ApplicationController::class, 'ipConsultation'])->name('applications.ip-consultation');
    Route::post('/ip-services/consultation', [ApplicationController::class, 'storeIpConsultation'])->name('applications.ip-consultation.store');
    Route::get('/documents', [DropboxController::class, 'index'])->name('documents.index');
    Route::post('/documents', [DropboxController::class, 'store'])->name('documents.store');
    Route::delete('/documents/{file}', [DropboxController::class, 'destroy'])->name('documents.destroy');
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{notificationId}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/notifications/read-all', [NotificationController::class, 'markAllAsRead'])->name('notifications.read-all');
    Route::get('/tech-transfer', [TechTransferController::class, 'index'])->name('tech-transfer.index');
    Route::get('/tech-transfer/apply', [TechTransferController::class, 'apply'])->name('tech-transfer.apply');
    Route::post('/tech-transfer', [TechTransferController::class, 'store'])->name('tech-transfer.store');
    Route::get('/tech-transfer/data', [TechTransferController::class, 'data'])->name('tech-transfer.data');
    Route::post('/tech-transfer/{application}/rate-trl', [TechTransferController::class, 'rateTrl'])->name('tech-transfer.rate-trl');
    Route::post('/tech-transfer/{application}/approve-schedule', [TechTransferController::class, 'approveSchedule'])->name('tech-transfer.approve-schedule');
    Route::post('/tech-transfer/{application}/proceed-tbi', [TechTransferController::class, 'proceedToTbi'])->name('tech-transfer.proceed-tbi');
    Route::post('/tech-transfer/{application}/meeting-decision', [TechTransferController::class, 'meetingDecision'])->name('tech-transfer.meeting-decision');
    Route::post('/tech-transfer/{application}/requirements', [TechTransferController::class, 'submitRequirements'])->name('tech-transfer.requirements');
    Route::get('/bizdev', [BizDevController::class, 'index'])->name('bizdev.index');
    Route::get('/bizdev/apply', [BizDevController::class, 'apply'])->name('bizdev.apply');
    Route::post('/bizdev', [BizDevController::class, 'store'])->name('bizdev.store');
    Route::get('/bizdev/data', [BizDevController::class, 'data'])->name('bizdev.data');
    Route::post('/bizdev/{application}/approve-schedule', [BizDevController::class, 'approveSchedule'])->name('bizdev.approve-schedule');
    Route::post('/bizdev/{application}/meeting-decision', [BizDevController::class, 'meetingDecision'])->name('bizdev.meeting-decision');
    Route::get('/bizdev/{application}/incubation', [BizDevController::class, 'incubation'])->name('bizdev.incubation');
    Route::post('/bizdev/{application}/incubation', [BizDevController::class, 'storeIncubation'])->name('bizdev.incubation.store');
    Route::post('/bizdev/{application}/evaluate', [BizDevController::class, 'evaluate'])->name('bizdev.evaluate');
    Route::post('/bizdev/{application}/advance-stage', [BizDevController::class, 'advanceStage'])->name('bizdev.advance-stage');
    Route::get('/applications/{application}/download', [ApplicationController::class, 'download'])->name('applications.download');
    Route::resource('applications', ApplicationController::class)->except(['destroy']);
});
