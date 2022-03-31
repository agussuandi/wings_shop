<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Cart\CartController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Report\ReportController;
use App\Http\Controllers\Checkout\CheckoutController;
use App\Http\Controllers\Products\ProductsController;

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

#HOME
Route::prefix('/')->group(function ()
{
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});

#CART
Route::prefix('/cart')->group(function ()
{
    Route::get('/', [CartController::class, 'index'])->name('cart');
    Route::post('/', [CartController::class, 'store'])->name('cart.store');
    Route::delete('/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
});

#CHECKOUT
Route::prefix('/checkout')->group(function ()
{
    Route::post('/', [CheckoutController::class, 'store'])->name('checkout.store');
});

#REPORT
Route::prefix('/report')->group(function ()
{
    Route::get('/', [ReportController::class, 'index'])->name('report');
    Route::get('/{id}', [ReportController::class, 'show'])->name('report.show');
});

#AUTHENTICATION
Route::prefix('/login')->group(function ()
{
    Route::get('/', [AuthController::class, 'index']);
    Route::post('/', [AuthController::class, 'login'])->name('login');
});

Route::middleware('auth')->group(function ()
{
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    #PRODUCTS
    Route::prefix('/products')->group(function ()
    {
        Route::get('/', [ProductsController::class, 'index'])->name('products');
        Route::get('/create', [ProductsController::class, 'create'])->name('products.create');
        Route::get('/{id}', [ProductsController::class, 'show'])->name('products.show');
        Route::post('/', [ProductsController::class, 'store'])->name('products.store');
        Route::get('/{id}/edit', [ProductsController::class, 'edit'])->name('products.edit');
        Route::put('/{id}', [ProductsController::class, 'update'])->name('products.update');
        Route::delete('/{id}', [ProductsController::class, 'destroy'])->name('products.destroy');
    });
});