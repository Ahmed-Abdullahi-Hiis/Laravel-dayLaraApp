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

// ✅ FRONTEND BLOG ROUTES (Public)
Route::prefix('blogs')->name('frontend.blogs.')->group(function () {
    Route::get('/', [BlogController::class, 'showBlogsPage'])->name('index');
    Route::get('/create', [BlogController::class, 'create'])->name('create'); // optional if frontend allows creation
    Route::post('/', [BlogController::class, 'store'])->name('store');        // optional
    Route::get('/{blog}', [BlogController::class, 'showSingleBlog'])->name('show');
});

// =======================
// ADMIN ROUTES
// =======================
Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // ✅ Admin Blogs (CRUD)
    Route::prefix('blogs')->name('blogs.')->group(function () {
        Route::get('/', [BlogController::class, 'index'])->name('index');       // list all blogs
        Route::get('/create', [BlogController::class, 'create'])->name('create'); // create form
        Route::post('/', [BlogController::class, 'store'])->name('store');       // store new blog
        Route::get('/{blog}/edit', [BlogController::class, 'edit'])->name('edit'); // edit form
        Route::put('/{blog}', [BlogController::class, 'update'])->name('update');  // update blog
        Route::delete('/{blog}', [BlogController::class, 'destroy'])->name('destroy'); // delete blog
    });

    // ✅ Admin Users CRUD
    Route::resource('users', UserController::class)->except(['show', 'create', 'store']);
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
