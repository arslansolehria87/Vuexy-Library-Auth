<?php
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
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

// === EMAIL VERIFICATION ROUTES ===
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/dashboard')->with('success', 'Email verified successfully!');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('success', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// Forgot Password Routes
Route::get('/forgot-password', function () { return view('auth.forgot-password'); })->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendOtp'])->name('password.email');

Route::get('/reset-password', function () { return view('auth.reset-password'); })->name('password.verify.form');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

// --- PROTECTED ROUTES (Sirf Login hone ke baad chalengi) ---
Route::middleware(['auth', ])->group(function () {
    
    // Dashboard (with email verification required)
    Route::get('/dashboard', function () {
        $bookCount = \App\Models\Book::where('user_id', auth()->id())->count();
        return view('dashboard', compact('bookCount'));
    })->name('dashboard');
    Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Yeh Category ka rasta hai
    Route::resource('categories', CategoryController::class);
    Route::resource('subcategories', SubCategoryController::class);
    Route::resource('products', ProductController::class);
});

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

  

    // Profile & Password Update
   // Profile & Settings Routes
   Route::get('/my-profile', [ProfileController::class, 'show'])->name('profile.show');
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::post('/profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
Route::post('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
Route::post('/teams/store', [ProfileController::class, 'storeTeam'])->name('teams.store');
Route::post('/projects/store', [ProfileController::class, 'storeProject'])->name('projects.store');
});
