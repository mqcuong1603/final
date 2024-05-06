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
    Route::get('/admin/changePassword/{email}', [AdminController::class, 'changePassword'])->name('admin.changePassword');
    Route::put('/admin/changePassword/{email}', [AdminController::class, 'updatePassword'])->name('admin.updatePassword');
    Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');
});

//Sales routes
Route::get('/sales/dashboard', 'SalesController@dashboard')->name('sales_dashboard');
Route::get('/sales/active', 'SalesController@active')->name('sales.active');


Route::get('/salesnew', function () {return view('sales.sales_new');});



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