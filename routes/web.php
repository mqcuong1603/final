<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\LoginController;
// use Illuminate\Support\Facades\View;


//Login routes
Route::get('/login', function () {
    return view('login');
});

Route::get('/admin', function () {
    return view('admin.admin_dashboard');
});

Route::get('/sales', function () {
    return view('sales.salesInfo');
});

Route::get('/logout', function () {
    return view('logout');
});


//product

Route::get('/admin/products', [ProductController::class, 'adminIndex'])->name('admin.products.index');
Route::get('/sales/products', [ProductController::class, 'salesIndex'])->name('sales.products.index');

Route::get('/products/', [ProductController::class, 'index']) ->name('products.index');
Route::get('/products/{productId}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/products/{productId}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/products/{productId}', [ProductController::class, 'destroy'])->name('products.destroy');
