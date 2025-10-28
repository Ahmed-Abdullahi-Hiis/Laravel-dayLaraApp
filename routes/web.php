<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Admin\UserController;

// =======================
// FRONTEND ROUTES
// =======================
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');

// Frontend blogs (users visiting the website)
Route::prefix('blogs')->group(function () {
    Route::get('/', [BlogController::class, 'index'])->name('blogs.index');
    Route::get('/create', [BlogController::class, 'create'])->name('blogs.create');
    Route::post('/', [BlogController::class, 'store'])->name('blogs.store');
    Route::get('/{blog}/edit', [BlogController::class, 'edit'])->name('blogs.edit');
    Route::put('/{blog}', [BlogController::class, 'update'])->name('blogs.update');
    Route::delete('/{blog}', [BlogController::class, 'destroy'])->name('blogs.destroy');
});

// =======================
// ADMIN ROUTES
// =======================
Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Admin Users CRUD (manage users)
    Route::resource('users', UserController::class)->except(['show', 'create', 'store']);

    // Admin Blogs CRUD (manage blogs)
    Route::resource('blogs', BlogController::class)->except(['show']);
});

// =======================
// PROFILE / AUTH ROUTES
// =======================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// =======================
// PRODUCT ROUTES (optional)
// =======================
Route::resource('products', App\Http\Controllers\ProductController::class);

// =======================
// AUTH
// =======================
require __DIR__ . '/auth.php';
