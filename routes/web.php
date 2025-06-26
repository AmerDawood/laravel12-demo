<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GoogleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 2FA routes (these will be handled by Fortify)
    Route::post('/two-factor/enable', function () {
        auth()->user()->enableTwoFactorAuthentication();
        return back()->with('status', 'تم تفعيل التحقق بخطوتين بنجاح!');
    })->name('two-factor.enable');

    Route::delete('/two-factor/disable', function () {
        auth()->user()->disableTwoFactorAuthentication();
        return back()->with('status', 'تم تعطيل التحقق بخطوتين.');
    })->name('two-factor.disable');
});

// Google OAuth routes
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

require __DIR__.'/auth.php';
