<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ProfileController;

// --- GUEST ROUTES (Baghair Login ke) ---

// Home page par aate hi Login par bhej do
Route::get('/', function () { 
    return redirect()->route('login'); 
});

// Login Routes
Route::get('/login', function () { return view('auth.login'); })->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login.submit');

// Register Routes
Route::get('/register', function () { return view('auth.register'); })->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('manual.register');

// Forgot Password Routes
Route::get('/forgot-password', function () { return view('auth.forgot-password'); })->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendOtp'])->name('password.email');

Route::get('/reset-password', function () { return view('auth.reset-password'); })->name('password.verify.form');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');


// --- PROTECTED ROUTES (Sirf Login hone ke baad chalengi) ---
Route::middleware(['auth'])->group(function () {
    
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Books CRUD (Saare operations: List, Create, Edit, Delete)
    Route::resource('books', BookController::class);

    // Profile & Password Update
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
});