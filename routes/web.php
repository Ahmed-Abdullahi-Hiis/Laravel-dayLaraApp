<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\EditController;
 
// =======================
// ADMIN ROUTES
// =======================
Route::prefix('admin')->group(function () {
    Route::get('/edit/{id}', [EditController::class, 'edit'])->name('admin.edit');
    Route::post('/edit/{id}', [EditController::class, 'update'])->name('admin.update');
});

Route::prefix('admin')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');

    // Admin dashboard
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

// =======================
// FRONTEND ROUTES
// =======================
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');

// Blog routes
Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
Route::get('/create/blog', [BlogController::class, 'create'])->name('blogs.create');
Route::post('/store/blog', [BlogController::class, 'store'])->name('blogs.store');

// Product routes (optional)
Route::resource('products', App\Http\Controllers\ProductController::class);

// =======================
// PROFILE / AUTH ROUTES
// =======================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
