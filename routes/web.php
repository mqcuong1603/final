<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\LoginController;
// use Illuminate\Support\Facades\View;


//Login routes
//Login routes
Route::get('/login', function () {
    return view('login');
});
Route::post('/login', [LoginController::class, 'login'])->name('login');

//admin routes
Route::get('/admin_dashboard', [AdminController::class, 'index'])->name('admin.admin_dashboard');

//Sales routes
Route::get('/sales/dashboard', 'SalesController@dashboard')->name('sales_dashboard');

//products routes
Route::get('/products/', [ProductController::class, 'index']) ->name('products.index');
Route::get('/products/{productId}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/products/{productId}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/products/{productId}', [ProductController::class, 'destroy'])->name('products.destroy');
