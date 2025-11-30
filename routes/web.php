<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LicenseController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishlistController;

Route::middleware('guest')->group(function () {
    Route::get('', function () {
        return redirect()->route('login');
    });

    Route::controller(AuthController::class)->group(function () {
        Route::get('login', 'showLoginForm')->name('login');
        Route::post('login', 'auth')->name('auth');
        
        Route::get('register', 'showRegisterForm')->name('register');
        Route::post('register', 'store')->name('store');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('', [HomeController::class, 'index'])->name('home');

    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::controller(UserController::class)->group(function () {
        Route::get('profile', 'show')->name('profile');
        Route::put('profile', 'update')->name('profile.update');
    });

    Route::resources([
        'categories' => CategoryController::class,
        'authors'    => AuthorController::class,
        'publishers' => PublisherController::class,
    ], ['only' => ['index', 'show']]);

    Route::controller(BookController::class)->group(function () {
        Route::get('books', 'index')->name('books.index');
        Route::get('books/{book:slug}', 'show')->name('books.show');
    });

    Route::get('bookmarks', [BookmarkController::class, 'index'])->name('bookmarks.index');
    Route::post('books/{book}/bookmark', [BookmarkController::class, 'store'])->name('bookmarks.store');
    Route::delete('bookmarks/{bookmark}', [BookmarkController::class, 'destroy'])->name('bookmarks.destroy');

    Route::get('favorites', [FavoriteController::class, 'index'])->name('favorites.index');
    Route::post('books/{book}/favorite', [FavoriteController::class, 'store'])->name('favorites.toggle');
    Route::delete('books/{book}/favorite', [FavoriteController::class, 'destroy'])->name('favorites.destroy');

    Route::get('wishlists', [WishlistController::class, 'index'])->name('wishlists.index');
    Route::post('books/{book}/wishlist', [WishlistController::class, 'store'])->name('wishlists.toggle');
    Route::delete('books/{book}/wishlist', [WishlistController::class, 'destroy'])->name('wishlists.destroy');

    Route::get('histories', [HistoryController::class, 'index'])->name('histories.index');
    Route::get('histories/{loan}', [HistoryController::class, 'show'])->name('histories.show');

    Route::get('/read/{book:slug}', [LoanController::class, 'store'])->name('loans.store');
    Route::patch('/loans/{loan}/progress', [LoanController::class, 'update'])->name('loans.update');
    Route::delete('/loans/{loan}/return', [LoanController::class, 'destroy'])->name('loans.destroy');

    Route::middleware('role:admin')->group(function () {
        Route::controller(UserController::class)->group(function () {
            Route::get('users', 'index')->name('users.index');
            Route::delete('users/{user}', 'destroy')->name('users.destroy');
        });

        Route::resources([
            'categories' => CategoryController::class,
            'authors'    => AuthorController::class,
            'publishers' => PublisherController::class,
        ], ['only' => ['store', 'update', 'destroy']]);

        Route::resource('books', BookController::class)->except(['index', 'show']);

        Route::delete('licenses/{license}', [LicenseController::class, 'destroy'])->name('licenses.destroy');
    });
});