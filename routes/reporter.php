<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Reporter\Auth\ReporterAuthController;
use App\Http\Controllers\Reporter\Auth\ReporterVerificationController;

Route::prefix('reporter')->name('reporter.')->group(function () {
    Route::middleware('guest:reporter')->group(function () {
        Route::view('login', 'reporter.auth.login')->name('login');
        Route::post('login', [ReporterAuthController::class, 'login']);
        // Route::view('register', 'website.reporter.registration')->name('register');
        Route::get('register', [ReporterAuthController::class, 'registrationForm'])->name('register');
        Route::post('register', [ReporterAuthController::class, 'register']);
    });

    Route::middleware('auth:reporter')->group(function () {
        Route::post('logout', [ReporterAuthController::class, 'logout'])->name('logout');
        Route::get('dashboard', [ReporterAuthController::class, 'dashboard'])->name('dashboard');

        // Route::view('dashboard', 'reporter.dashboard')->name('dashboard');

        // Route::get('email/verify', [ReporterVerificationController::class, 'notice'])->name('verification.notice');

        // Route::get('email/verify/{id}/{hash}', [ReporterVerificationController::class, 'verify'])->name('verification.verify');

        // Route::post('email/resend', [ReporterVerificationController::class, 'resend'])->name('verification.resend');
    });

    Route::middleware('auth:reporter')->group(function () {
        Route::get('email/verify', [ReporterVerificationController::class, 'notice'])->name('verification.notice');
        Route::get('email/verify/{id}/{hash}', [ReporterVerificationController::class, 'verify'])->name('verification.verify');
        Route::post('email/resend', [ReporterVerificationController::class, 'resend'])->name('verification.resend');
    });
});
