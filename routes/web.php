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
Route::post('/login', [LoginController::class, 'login'])->name('login');

//admin routes
Route::prefix('admin_dashboard')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.admin_dashboard');
    Route::get('/lock/{email}', [AdminController::class, 'lock'])->name('admin.lock');
    Route::get('/unlock/{email}', [AdminController::class, 'unlock'])->name('admin.unlock');
    Route::get('/delete/{salesman}', [AdminController::class, 'delete'])->name('admin.delete');
    Route::put('/update/{email}', [AdminController::class, 'update'])->name('admin.update');
    Route::get('/{id}/edit', [AdminController::class, 'edit'])->name('admin.edit');
});

//Sales routes
Route::get('/sales/dashboard', 'SalesController@dashboard')->name('sales_dashboard');

Route::get('/salesnew', function () {return view('sales.sales_new');});



//products routes
Route::get('/products/', [ProductController::class, 'index']) ->name('products.index');
Route::get('/products/{productId}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/products/{productId}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/products/{productId}', [ProductController::class, 'destroy'])->name('products.destroy');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products',[ProductController::class, 'store'])->name('products.store');

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');