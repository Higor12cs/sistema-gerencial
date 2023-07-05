<?php

use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Product\ProductBrandController;
use App\Http\Controllers\Product\ProductCategoryController;
use App\Http\Controllers\Product\ProductColorController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Product\ProductSeasonController;
use App\Http\Controllers\Product\ProductSizeController;
use App\Http\Controllers\Product\ProductVariantController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::view('/', 'welcome')->name('welcome');

Auth::routes([
    'login' => true,
    'logout' => true,
    'register' => false,
    'reset' => false,
    'confirm' => false,
    'verify' => false,
]);

Route::middleware('auth')->prefix('/app')->as('app.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::resource('/customers', CustomerController::class);
    Route::resource('/products', ProductController::class);
    Route::resource('/product-variants', ProductVariantController::class);
    Route::resource('/product-brands', ProductBrandController::class);
    Route::resource('/product-categories', ProductCategoryController::class);
    Route::resource('/product-seasons', ProductSeasonController::class);
    Route::resource('/product-sizes', ProductSizeController::class);
});
