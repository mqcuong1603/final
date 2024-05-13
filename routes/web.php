<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SalesmanController;
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
    Route::delete('/delete/{email}', [AdminController::class, 'delete'])->name('admin.delete');
    Route::put('/update/{email}', [AdminController::class, 'update'])->name('admin.update');
    Route::get('/search', [AdminController::class, 'searchSalesman'])->name('admin.search');
    Route::post('/create', [AdminController::class, 'createSaleAccount'])->name('admin.create');
    Route::get('/admin/changePassword/{email}', [AdminController::class, 'changePassword'])->name('admin.changePassword');
    Route::put('/admin/changePassword/{email}', [AdminController::class, 'updatePassword'])->name('admin.updatePassword');
    Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');
});

//Sales routes
//Sales routes
Route::prefix('sales_dashboard')->group(function () {
    Route::get('/', [SalesmanController::class, 'index'])->name('sales.sales_dashboard');
    Route::get('/search', [SalesmanController::class, 'searchCustomer'])->name('sales.search');
    Route::get('sales_transaction', [SalesmanController::class, 'transaction'])->name('sales.sales_transaction');
    Route::get('/logout', [LoginController::class, 'logout'])->name('sales.logout');
    Route::get('/report', [SalesmanController::class, 'report'])->name('sales.report');
    Route::get('/detail/{customerId}', [SalesmanController::class, 'detail'])->name('sales.detail');
    Route::post('/check_customer', [SalesmanController::class, 'checkCustomer'])->name('sales.checkCustomer');
    Route::get('/report', [SalesmanController::class, 'report'])->name('sales.report');
    Route::get('/changePassword/{email}', [SalesmanController::class, 'changePassword'])->name('sales.changePassword');
    Route::put('/changePassword/{email}', [SalesmanController::class, 'updatePassword'])->name('sales.updatePassword');
});



//products routes
Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('products.index');
    Route::get('/{productId}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/{productId}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/{productId}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::get('/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/', [ProductController::class, 'store'])->name('products.store');
    Route::get('/search', [ProductController::class, 'searchProduct'])->name('product.search');
});




Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

//change password routes
Route::get('/changePass', function () {
    return view('admin.changePass');
});