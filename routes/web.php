<?php

use App\Http\Controllers\LaundryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('splade')->group(function () {
    // Registers routes to support the interactive components...
    Route::spladeWithVueBridge();

    // Registers routes to support password confirmation in Form and Link components...
    Route::spladePasswordConfirmation();

    // Registers routes to support Table Bulk Actions and Exports...
    Route::spladeTable();

    // Registers routes to support async File Uploads with Filepond...
    Route::spladeUploads();

    Route::get('/', function () {
        return view('welcome');
    });

    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->middleware(['verified'])->name('dashboard');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    // Manage Promo
    Route::middleware(['auth', 'can:manage-promo'])->prefix('/promo')->name('promo.')->group(function () {
        Route::get('/', [PromoController::class, 'index'])->name('index');
    });

    // Manage Users
    Route::middleware(['auth', 'can:manage-user'])->prefix('/users')->name('user.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/store', [UserController::class, 'store'])->name('store');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
        Route::put('/{user}/update', [UserController::class, 'update'])->name('update');
        Route::delete('/{user}/destroy', [UserController::class, 'destroy'])->name('destroy');
    });

    // Manage Shop
    Route::middleware(['auth', 'can:manage-shop'])->prefix('/shops')->name('shop.')->group(function () {
        Route::get('/', [ShopController::class, 'index'])->name('index');
        Route::get('/create', [ShopController::class, 'create'])->name('create');
        Route::post('/store', [ShopController::class, 'store'])->name('store');
        Route::get('/{shop}/edit', [ShopController::class, 'edit'])->name('edit');
        Route::put('/{shop}/update', [ShopController::class, 'update'])->name('update');
        Route::delete('/{shop}/destroy', [ShopController::class, 'destroy'])->name('destroy');
    });

    // Manage promo
    Route::middleware(['auth', 'can:manage-promo'])->prefix('/promo')->name('promo.')->group(function () {
        Route::get('/', [PromoController::class, 'index'])->name('index');
        Route::get('/create', [PromoController::class, 'create'])->name('create');
        Route::post('/store', [PromoController::class, 'store'])->name('store');
        Route::get('/{promo}/edit', [PromoController::class, 'edit'])->name('edit');
        Route::put('/{promo}/update', [PromoController::class, 'update'])->name('update');
        Route::delete('/{promo}/destroy', [PromoController::class, 'destroy'])->name('destroy');
    });

    // Manage Laundry
    Route::middleware(['auth', 'can:manage-laundries'])->prefix('/laundries')->name('laundry.')->group(function () {
        Route::get('/create', [LaundryController::class, 'create'])->name('create');
        Route::post('/store', [LaundryController::class, 'store'])->name('store');
        Route::get('/{laundry}/edit', [LaundryController::class, 'edit'])->name('edit');
        Route::put('/{laundry}/update', [LaundryController::class, 'update'])->name('update');
        Route::delete('/{laundry}/destroy', [LaundryController::class, 'destroy'])->name('destroy');
    });

    // Public with AUTH
    Route::middleware(['auth'])->group(function () {
        Route::get('/laundries', [LaundryController::class, 'index'])->name('laundry.index'); // user view my laundry
        Route::get('/laundry/order', [LaundryController::class, 'order'])->name('laundry.order'); // user claim an order
        Route::put('/laundry/claim', [LaundryController::class, 'claim'])->name('laundry.claim'); // 
    });


    require __DIR__ . '/auth.php';
});
