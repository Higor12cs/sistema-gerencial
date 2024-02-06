<?php

declare(strict_types=1);

use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Order\OrderController;
use App\Http\Controllers\Product\ProductBrandController;
use App\Http\Controllers\Product\ProductCategoryController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Product\ProductSeasonController;
use App\Http\Controllers\Product\ProductSizeController;
use App\Http\Controllers\Stock\StockController;
use App\Http\Controllers\Trial\TrialController;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByRequestData;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware(['web', 'auth', 'tenant.header', InitializeTenancyByRequestData::class])->group(function () {
    Route::get('/tenant', function () {
        return 'This is your multi-tenant application. The id of the current tenant is '.tenant('id');
    });

    Route::prefix('/app')->as('app.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
        Route::resource('/customers', CustomerController::class);
        Route::resource('/products', ProductController::class);
        Route::resource('/product-brands', ProductBrandController::class);
        Route::resource('/product-categories', ProductCategoryController::class);
        Route::resource('/product-seasons', ProductSeasonController::class);
        Route::resource('/product-sizes', ProductSizeController::class);
        Route::resource('/trials', TrialController::class)->except(['store', 'update']);
        Route::resource('/orders', OrderController::class)->except(['store', 'update']);
        Route::get('/stocks', [StockController::class, 'index'])->name('stocks.index');
    });
});
