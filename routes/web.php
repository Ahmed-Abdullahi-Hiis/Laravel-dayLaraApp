<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BloggerBlogController;
use App\Http\Controllers\Admin\AdminBlogController;
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

Route::prefix('blogs')->name('frontend.blogs.')->group(function () {
    Route::get('/', [BlogController::class, 'showBlogsPage'])->name('index');
    Route::get('/{blog}', [BlogController::class, 'showSingleBlog'])->name('show');
});

/*
|--------------------------------------------------------------------------
| BLOGGER ROUTES
|--------------------------------------------------------------------------
*/
Route::prefix('blogger')
    ->name('blogger.')
    ->middleware(['auth', 'blogger'])
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', function () {
            return view('blogger.dashboard');
        })->name('dashboard');

        // Blogger Blogs CRUD
        Route::resource('blogs', BloggerBlogController::class);

        // Blogger Reports
        Route::view('/reports', 'blogger.reports')->name('reports');

        // Blogger Settings
        Route::view('/settings', 'blogger.settings')->name('settings');
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

        // Reports
        Route::get('/reports', function () {
            return view('admin.reports');
        })->name('reports');

        // Settings
        Route::get('/settings', function () {
            return view('admin.settings');
        })->name('settings');

        // Admin Blogs CRUD
        Route::resource('blogs', AdminBlogController::class);

        // Admin Users CRUD
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
