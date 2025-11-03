<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| ROLE-BASED REDIRECT AFTER LOGIN
|--------------------------------------------------------------------------
*/
Route::get('/redirect', function () {
    $user = Auth::user();

    if (!$user) {
        return redirect()->route('login');
    }

    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif ($user->role === 'blogger') {
        return redirect()->route('blogger.dashboard');
    } else {
        return redirect()->route('home');
    }
})->middleware(['auth'])->name('redirect');


/*
|--------------------------------------------------------------------------
| DASHBOARD (Shared Entry Point)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    $user = Auth::user();

    if (!$user) {
        return redirect()->route('login');
    }

    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif ($user->role === 'blogger') {
        return redirect()->route('blogger.dashboard');
    } else {
        return redirect()->route('home');
    }
})->middleware(['auth', 'verified'])->name('dashboard');


/*
|--------------------------------------------------------------------------
| FRONTEND ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');

// ✅ Public Blogs (Frontend)
Route::prefix('blogs')->name('frontend.blogs.')->group(function () {
    Route::get('/', [BlogController::class, 'showBlogsPage'])->name('index');
    Route::get('/{blog}', [BlogController::class, 'showSingleBlog'])->name('show');
});


/*
|--------------------------------------------------------------------------
| BLOGGER ROUTES
|--------------------------------------------------------------------------
*/
Route::prefix('blogger')->middleware(['auth', 'blogger'])->group(function () {
    Route::get('/dashboard', function () {
        return view('blogger.dashboard');
    })->name('blogger.dashboard');
});


/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'verified', 'admin'])
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        // ✅ Admin Blogs CRUD
        Route::prefix('blogs')->name('blogs.')->group(function () {
            Route::get('/', [BlogController::class, 'index'])->name('index');
            Route::get('/create', [BlogController::class, 'create'])->name('create');
            Route::post('/', [BlogController::class, 'store'])->name('store');
            Route::get('/{blog}/edit', [BlogController::class, 'edit'])->name('edit');
            Route::put('/{blog}', [BlogController::class, 'update'])->name('update');
            Route::delete('/{blog}', [BlogController::class, 'destroy'])->name('destroy');
        });

        // ✅ Admin Users CRUD
        Route::resource('users', UserController::class)->except(['show', 'create', 'store']);
    });


/*
|--------------------------------------------------------------------------
| PROFILE ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


/*
|--------------------------------------------------------------------------
| PRODUCTS (Optional)
|--------------------------------------------------------------------------
*/
Route::resource('products', ProductController::class);


/*
|--------------------------------------------------------------------------
| AUTHENTICATION (Breeze)
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';
