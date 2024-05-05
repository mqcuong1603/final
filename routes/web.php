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
    Route::put('/lock/{email}', [AdminController::class, 'changeLock'])->name('admin.changeLock');
    Route::get('/delete/{salesman}', [AdminController::class, 'delete'])->name('admin.delete');
    Route::put('/update/{email}', [AdminController::class, 'update'])->name('admin.update');
    Route::get('/search', [AdminController::class, 'searchSalesman'])->name('admin.search');
    Route::post('/create', [AdminController::class, 'createSaleAccount'])->name('admin.create');
});

//Sales routes
Route::get('/sales/dashboard', 'SalesController@dashboard')->name('sales_dashboard');
Route::get('/sales/active', 'SalesController@active')->name('sales.active');


Route::get('/salesnew', function () {return view('sales.sales_new');});



//products routes
Route::get('/products/', [ProductController::class, 'index']) ->name('products.index');
Route::get('/products/{productId}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/products/{productId}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/products/{productId}', [ProductController::class, 'destroy'])->name('products.destroy');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products',[ProductController::class, 'store'])->name('products.store');

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

//change password routes
Route::get('/changePass', function () {
    return view('admin.changePass');
});