<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [LandingController::class, 'index'])->name('landing.index');
Route::get('/detail/{id}', [LandingController::class, 'detail'])->name('landing.detail');

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
    Route::get('/login/forgot', [LoginController::class, 'forgot'])->name('login.forgot');
});

Route::middleware('auth')->group(function () {

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/profile/{id}', [LandingController::class, 'profile'])->name('landing.profile');
    Route::put('/profile/{id}', [LandingController::class, 'update'])->name('land-profile.update');

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::post('landing/cart/{id}', [CartController::class, 'landingAdd'])->name('cart.add-landing');
    Route::get('landing/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::get('/cart/confirm', [CartController::class, 'confirm'])->name('cart.confirm');
    Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::delete('/cart', [CartController::class, 'destroyAll'])->name('cart.destroyAll');


    // Product
    Route::get('/product', [ProductController::class, 'index'])->name('product.index');

    Route::middleware(['role:admin|staff'])->group(function () {
        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/dashboard/{id}', [DashboardController::class, 'profile'])->name('dashboard.profile');
        Route::put('/dashboard/{id}', [DashboardController::class, 'update'])->name('dash-profile.update');

        // Product
        Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
        Route::post('/product', [ProductController::class, 'store'])->name('product.store');

        Route::middleware(['role:admin'])->group(function () {
            Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
            Route::put('/product/{id}', [ProductController::class, 'update'])->name('product.update');
            Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
            Route::get('/product/approve/{id}', [ProductController::class, 'approve'])->name('product.approve');
        });

        // Brand
        Route::get('/product/brand', [BrandController::class, 'index'])->name('brand.index');
        Route::middleware(['role:admin'])->group(function () {
            Route::get('/product/brand/create', [BrandController::class, 'create'])->name('brand.create');
            Route::post('/product/brand', [BrandController::class, 'store'])->name('brand.store');
            Route::get('/product/brand/edit/{id}', [BrandController::class, 'edit'])->name('brand.edit');
            Route::put('/product/brand/{id}', [BrandController::class, 'update'])->name('brand.update');
            Route::delete('/product/brand/{id}', [BrandController::class, 'destroy'])->name('brand.destroy');
        });

        // Category
        Route::get('/product/category', [CategoryController::class, 'index'])->name('category.index');

        Route::middleware(['role:admin'])->group(function () {
            Route::get('/product/category/create', [CategoryController::class, 'create'])->name('category.create');
            Route::post('/product/category', [CategoryController::class, 'store'])->name('category.store');
            Route::get('/product/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
            Route::put('/product/category/{id}', [CategoryController::class, 'update'])->name('category.update');
            Route::delete('/product/category/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
        });

        // User
        Route::get('/user', [UserController::class, 'index'])->name('user.index');

        Route::middleware(['role:admin'])->group(function () {
            Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
            Route::post('/user', [UserController::class, 'store'])->name('user.store');
            Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
            Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
            Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');
        });

        // Role
        Route::get('/user/role', [RoleController::class, 'index'])->name('role.index');

        Route::middleware(['role:admin'])->group(function () {
            Route::get('/user/role/create', [RoleController::class, 'create'])->name('role.create');
            Route::post('/user/role', [RoleController::class, 'store'])->name('role.store');
            Route::get('/user/role/edit/{id}', [RoleController::class, 'edit'])->name('role.edit');
            Route::put('/user/role/{id}', [RoleController::class, 'update'])->name('role.update');
            Route::delete('/user/role/{id}', [RoleController::class, 'destroy'])->name('role.destroy');
        });

        // Slider
        Route::get('/slider', [SliderController::class, 'index'])->name('slider.index');
        Route::get('/slider/create', [SliderController::class, 'create'])->name('slider.create');
        Route::post('/slider', [SliderController::class, 'store'])->name('slider.store');

        Route::middleware(['role:admin'])->group(function () {
            Route::get('/slider/edit/{id}', [SliderController::class, 'edit'])->name('slider.edit');
            Route::put('/slider/{id}', [SliderController::class, 'update'])->name('slider.update');
            Route::delete('/slider/{id}', [SliderController::class, 'destroy'])->name('slider.destroy');
            Route::get('/slider/approve/{id}', [SliderController::class, 'approve'])->name('slider.approve');
        });

        // Transaction
        Route::get('/transaction', [TransactionController::class, 'index'])->name('transaction.index');
        Route::middleware(['role:admin'])->group(function () {
            Route::get('/transaction/approve/{id}', [TransactionController::class, 'approve'])->name('transaction.approve');
            Route::get('/transaction/detail/{id}', [TransactionController::class, 'detail'])->name('transaction.detail');
            Route::delete('/transaction/{id}', [TransactionController::class, 'destroy'])->name('transaction.destroy');
        });
    });
});
