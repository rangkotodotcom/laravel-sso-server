<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomPassportAuthorizationController;
use App\Http\Controllers\DocsController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MicrosoftController;
use App\Http\Controllers\ProfileController;

// Route::get('/auth/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
// Route::post('/auth/login', [AuthController::class, 'authentication']);
// Route::get('/auth/logout', [AuthController::class, 'logout'])->name('logout');
// Route::get('/auth/register', [AuthController::class, 'register'])->name('register')->middleware('guest');
// Route::get('/auth/forgot-password', [AuthController::class, 'forgotPassword'])->name('forgotpassword');
Route::get('/google/login', [GoogleController::class, 'redirectLogin'])->name('login.google');
Route::get('/microsoft/login', [MicrosoftController::class, 'redirectLogin'])->name('login.microsoft');
Route::get('/google/register', [GoogleController::class, 'redirectRegister'])->name('register.google');
Route::get('/microsoft/register', [MicrosoftController::class, 'redirectRegister'])->name('register.microsoft');

Route::get('/auth/personal', [AuthController::class, 'personal']);
Route::get('/docs/oauth', [DocsController::class, 'oauth']);




Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/oauth/authorize', [CustomPassportAuthorizationController::class, 'authorize'])
        ->name('passport.authorizations.authorize');

    Route::get('/', [HomeController::class, 'index']);
    Route::get('/profile', [ProfileController::class, 'index']);
});
