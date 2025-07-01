<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GoogleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserRoleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\TestController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


Route::get('{role}/dashboard', [DashboardController::class, 'index'])
    ->where('role', 'admin|instructor|user')
    ->name('dashboard');
// Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');



    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');







    //  *****  Tests Routes   *****



// اختبارات CRUD
Route::resource('tests', TestController::class);

// Soft delete & Restore
Route::get('tests/trashed', [TestController::class, 'trashed'])->name('tests.trashed');
Route::put('tests/{id}/restore', [TestController::class, 'restore'])->name('tests.restore');

// الأسئلة المرتبطة بكل اختبار
Route::prefix('tests/{test}')->group(function () {
    Route::resource('questions', QuestionController::class)->except(['show']);
        Route::get('questions-trashed', [QuestionController::class, 'trashed'])->name('questions.trashed');
    Route::put('questions/{id}/restore', [QuestionController::class, 'restore'])->name('questions.restore');
});





});


// Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('/admin/users', [UserRoleController::class, 'index'])->name('admin.users.index');
    Route::post('/admin/users/{user}/roles', [UserRoleController::class, 'update'])->name('admin.users.update');
// });


// Google OAuth routes
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

require __DIR__.'/auth.php';
